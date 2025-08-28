<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UPTD;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Models\JenisKomoditas;
use App\Models\HargaMonitoring;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // $perkembangan = HargaMonitoring::with(['komoditas','pasar','user'])->get()->groupBy('komoditas.nama')->toArray();

        $perkembangan = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])->whereHas('harga_monitorings')->get()->map(function ($perkembangan) {
            return [
                'komoditas' => $perkembangan->komoditas->nama_komoditas,
                'harga_monitorings' => $perkembangan->harga_monitorings,
            ];
        });

        $uptd = UPTD::select('id', 'nama_uptd')->get();


        $data = [

            'title' => 'Perkembangan Harga',
            'description' => 'Halaman ini menampilkan perkembangan harga komoditas yang ada di dalam database',
            'perkembanganHargas' => $perkembangan,
            'modul' => 'Perkembangan Harga',
            'route_create' => $this->routeCreate,

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
            'description' => 'Halaman ini digunakan untuk menambahkan data komoditas yang baru',
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
        if (is_null($tanggal_awal) && is_null($tanggal_akhir)) {
            $komoditas = JenisKomoditas::with([
                'harga_monitorings.pasar.uptd',
                'komoditas',
                'harga_monitorings.jenis_komoditas'
            ])->get();
        } else {
            $komoditas = JenisKomoditas::whereHas('harga_monitorings', function ($q) use ($tanggal_awal, $tanggal_akhir) {
                if ($tanggal_awal && $tanggal_akhir) {
                    $q->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                }
            })->get();

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
}
