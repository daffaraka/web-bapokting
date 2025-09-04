<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UPTD;
use App\Models\User;
use App\Models\Pasar;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Models\JenisKomoditas;
use App\Models\HargaMonitoring;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerkembanganHargaExport;

class PerkembanganHargaController extends Controller
{
    protected $routeCreate;


    public function __construct()
    {
        $this->routeCreate = route('perkembangan-harga.create');
    }
    public function index()
    {




        $user = User::with('uptd.pasars')->find(Auth::user()->id);

        // $perkembangan = HargaMonitoring::with(['komoditas','pasar','user'])->get()->groupBy('komoditas.nama')->toArray();

        if (Auth::user()->hasRole('admin')) {
            $perkembangan = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])
                ->whereHas('harga_monitorings')
                ->get()->map(function ($perkembangan) {
                    return [
                        'komoditas' => $perkembangan->komoditas->nama_komoditas,
                        'harga_monitorings' => $perkembangan->harga_monitorings,
                    ];
                });
        } else {
            $pasar = $user->uptd->pasars->pluck('id')->toArray();


            // dd($pasar);

            $perkembangan = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])
                ->whereHas('harga_monitorings', function ($q) use ($pasar) {
                    $q->whereIn('pasar_id', $pasar);
                })->get()->map(function ($perkembangan) {
                    return [
                        'komoditas' => $perkembangan->komoditas->nama_komoditas,
                        'harga_monitorings' => $perkembangan->harga_monitorings,
                    ];
                });
        }


        // dd($perkembangan);


        $data = [

            'title' => 'Perkembangan Harga',
            'description' => 'Halaman ini menampilkan perkembangan harga komoditas yang ada di dalam database',
            'perkembanganHargas' => $perkembangan,
            'modul' => 'Perkembangan Harga',
            'route_create' => $this->routeCreate,
            'create_permission' => 'perkembangan-harga-create',

        ];
        return view('dashboard.perkembangan-harga.perkembangan-harga-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Perkembangan Harga Jenis Komoditas',
            'description' => 'Halaman ini digunakan untuk menambahkan perkembangan harga',
            'komoditas' => Komoditas::all(),
            'uptd' => UPTD::all(),

        ];

        return view('dashboard.perkembangan-harga.perkembangan-harga-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis_komoditas_id' => 'required',
                'pasar_id' => 'required',
                'harga' => 'required',
                'stok' => 'required',
            ],
            [
                'jenis_komoditas_id.required' => 'Jenis Komoditas wajib dipilih',
                'pasar_id.required' => 'Pasar wajib dipilih',
                'harga.required' => 'Harga wajib diisi',
                'stok.required' => 'Stok wajib diisi',
            ]
        );


        HargaMonitoring::create([
            'jenis_komoditas_id' => $request->jenis_komoditas_id,
            'pasar_id' => $request->pasar_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal ?? Carbon::now()->format('Y-m-d'),
        ]);

        return redirect()->route('perkembangan-harga.index')->with('success', 'Perkembangan harga berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HargaMonitoring $perkembanganHarga)
    {
        // dd($perkembanganHarga);
        $data = [
            'title' => 'Edit Perkembangan Harga Jenis Komoditas',
            'description' => 'Halaman ini digunakan untuk memperbarui perkembangan harga',
            'komoditas' => Komoditas::all(),
            'uptd' => UPTD::all(),
            'perkembanganHarga' => $perkembanganHarga->load('jenis_komoditas.komoditas', 'pasar.uptd'),

        ];

        return view('dashboard.perkembangan-harga.perkembangan-harga-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HargaMonitoring $perkembanganHarga)
    {
        $request->validate(
            [
                'jenis_komoditas_id' => 'required',
                'pasar_id' => 'required',
                'harga' => 'required',
                'stok' => 'required',
            ],
            [
                'jenis_komoditas_id.required' => 'Jenis Komoditas wajib dipilih',
                'pasar_id.required' => 'Pasar wajib dipilih',
                'harga.required' => 'Harga wajib diisi',
                'stok.required' => 'Stok wajib diisi',
            ]
        );


        $perkembanganHarga->update([
            'jenis_komoditas_id' => $request->jenis_komoditas_id,
            'pasar_id' => $request->pasar_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->tanggal ?? Carbon::now()->format('Y-m-d'),
        ]);

        return redirect()->route('perkembangan-harga.index')->with('success', 'Perkembangan harga berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HargaMonitoring $perkembanganHarga)
    {
        $perkembanganHarga->delete();
        return redirect()->route('perkembangan-harga.index')->with('success', 'Perkembangan harga berhasil dihapus');
    }



    public function downloadFile(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $download = $request->download;

        $data = $this->getPerkembanganHargaData($tanggal_awal, $tanggal_akhir);


        if ($download == 'excel') {
            return $this->export($data);
        } else {
            return $this->print($data);
        }
    }



    public function export($data)
    {
        $fileName = 'perkembangan-harga-' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new PerkembanganHargaExport($data), $fileName);
    }
    public function print($data)
    {
        $pdf = Pdf::loadView('dashboard.perkembangan-harga.perkembangan-harga-print', [
            'perkembanganHargas' => $data
        ]);

        return $pdf->stream('perkembangan-harga-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }




    protected function getPerkembanganHargaData($tanggal_awal, $tanggal_akhir)
    {

        $user = User::with('uptd.pasars')->find(Auth::user()->id);
        $pasar = $user->uptd->pasars->pluck('id')->toArray();



        if (is_null($tanggal_awal) && is_null($tanggal_akhir)) {

            if (Auth::user()->hasRole('admin')) {
                $komoditas = JenisKomoditas::with([
                    'harga_monitorings.pasar.uptd',
                    'komoditas',
                    'harga_monitorings.jenis_komoditas'
                ])->get();
            } else {
                $komoditas = JenisKomoditas::with([
                    'harga_monitorings.pasar.uptd',
                    'komoditas',
                    'harga_monitorings.jenis_komoditas'
                ])->whereHas('harga_monitorings', function ($q) use ($pasar) {
                    $q->whereIn('pasar_id', $pasar);
                })->get();
            }
        } else {
            if (Auth::user()->hasRole('admin')) {
                $komoditas = JenisKomoditas::whereHas('harga_monitorings', function ($q) use ($tanggal_awal, $tanggal_akhir) {
                    if ($tanggal_awal && $tanggal_akhir) {
                        $q->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                    }
                })->get();
            } else {
                $komoditas = JenisKomoditas::whereHas('harga_monitorings', function ($q) use ($tanggal_awal, $tanggal_akhir, $pasar) {
                    $q->whereIn('pasar_id', $pasar);
                    if ($tanggal_awal && $tanggal_akhir) {
                        $q->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                    }
                })->get();
            }

            $komoditas->load([
                'harga_monitorings' => function ($q) use ($tanggal_awal, $tanggal_akhir) {
                    if ($tanggal_awal && $tanggal_akhir) {
                        $q->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                    }
                },
                'harga_monitorings.pasar.uptd',
                'komoditas',
                'harga_monitorings.jenis_komoditas'
            ]);
        }



        return $komoditas->map(function ($perkembangan) {
            return [
                'komoditas' => $perkembangan->komoditas->nama_komoditas,
                'harga_monitorings' => $perkembangan->harga_monitorings,
            ];
        });
    }
    // }


    public function getSelect(Request $request)
    {

        $data = '';
        if ($request->has('uptd_id')) {
            $data = Pasar::where('uptd_id', $request->uptd_id)->get();
            return response()->json($data);
        } else {
            $data = JenisKomoditas::where('komoditas_id', $request->komoditas_id)->get();
            return response()->json($data);
        }
    }
}
