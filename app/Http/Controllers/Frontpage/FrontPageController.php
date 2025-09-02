<?php

namespace App\Http\Controllers\Frontpage;

use Carbon\Carbon;
use App\Models\Pasar;
use App\Models\Berita;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Models\JenisKomoditas;
use App\Models\HargaMonitoring;
use App\Http\Controllers\Controller;

class FrontPageController extends Controller
{
    public function index()
    {

        $count = HargaMonitoring::count();
        $limit = $count > 5 ? 5 : $count;
        $hargaMonitoring  = HargaMonitoring::with(['jenis_komoditas', 'pasar', 'user']);

        $hargaMonitoringData = $hargaMonitoring->clone()->get()
            ->groupBy('jenis_komoditas.nama_jenis')
            ->sortByDesc(function ($group) {
                return $group->count();
            })->take($limit);






        $datasets = [];
        $primaryColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];
        $colorIndex = 0;

        foreach ($hargaMonitoringData as $komoditas => $dataGroup) {
            $sorted = $dataGroup->sortBy('tanggal');
            $color = $primaryColors[$colorIndex];
            $colorIndex = ($colorIndex + 1) % count($primaryColors);



            $datasets[] = [
                'label' => $komoditas,
                'borderColor' => $color,
                'pointBorderColor' => '#FFF',
                'pointBackgroundColor' => $color,
                'pointBorderWidth' => 2,
                'pointHoverRadius' => 4,
                'pointHoverBorderWidth' => 1,
                'pointRadius' => 4,
                'backgroundColor' => 'rgba(0,0,0,0.05)',
                'fill' => true,
                'borderWidth' => 2,
                'data' => $sorted->pluck('harga')->values(),
            ];
        }

        //  dd($sorted->values()->get(0));



        $bulanTerakhir = $hargaMonitoringData->flatten()->max('tanggal');
        $bulanTerakhirCarbon = Carbon::parse($bulanTerakhir);
        $labels = collect();

        for ($i = 1; $i <= $bulanTerakhirCarbon->month; $i++) {
            $labels->push(Carbon::create(null, $i, 1)->format('M'));
        }



        $berita = Berita::where('status_berita', 'published')->limit(6)->get();


        $data = [
            'berita' => $berita,
            'hargaMonitorings' => $hargaMonitoring,
            'labels' => $labels,
            'datasets' => $datasets,
        ];
        return view('frontend.index', $data);
    }

    public function showBerita($id)
    {
        $berita = Berita::find($id);

        return view('frontend.show-berita', compact('berita'));
    }

    public function profilBapokting()
    {
        return view('frontend.profil-bapokting');
    }


    public function barangPenting()
    {
        $barangPenting = Komoditas::with('jenis_komoditas')->where('type_komoditas', 'Penting')->get();
        $title = 'Barang Penting';
        $deskripsi = 'Barang Pokok adalah komoditas yang sangat dibutuhkan dalam kehidupan sehari-hari dan memiliki nilai strategis tinggi. Berikut adalah daftar Barang Pokok yang diawasi harga dan ketersediaannya oleh Badan Pengawasan dan Pengendalian Daging (Bapokting) Kabupaten Tangerang.';

        $data = [
            'barangPenting' => $barangPenting,
            'title' => $title,
            'deskripsi' => $deskripsi
        ];
        return view('frontend.barang-penting', $data);
    }

    public function barangPokok()
    {
        $barangPokok = Komoditas::where('type_komoditas', 'Pokok')->get();
        $title = 'Barang Pokok';
        $deskripsi = 'Barang Pokok adalah komoditas yang sangat dibutuhkan dalam kehidupan sehari-hari dan memiliki nilai strategis tinggi. Berikut adalah daftar Barang Pokok yang diawasi harga dan ketersediaannya oleh Badan Pengawasan dan Pengendalian Daging (Bapokting) Kabupaten Tangerang.';
        $data = [
            'barangPokok' => $barangPokok,
            'title' => $title,
            'deskripsi' => $deskripsi
        ];
        return view('frontend.barang-pokok', $data);
    }

    public function hargaPerPasar()
    {
        $perkembangan = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])->whereHas('harga_monitorings')->get()->map(function ($perkembangan) {
            return [
                'komoditas' => $perkembangan->komoditas->nama_komoditas,
                'harga_monitorings' => $perkembangan->harga_monitorings,
            ];
        });
        $title = 'Harga Per Pasar';
        $deskripsi = 'Berikut adalah daftar harga komoditas yang diawasi oleh Badan Barang Kebutuhan Pokok dan Barang Penting per pasar.';
        $pasar = Pasar::all();

        $data = [
            'perkembangan' => $perkembangan,
            'title' => $title,
            'pasar' => $pasar,
            'deskripsi' => $deskripsi
        ];
        return view('frontend.harga-per-pasar', $data);
    }


    public function filterPasar(Request $request)
    {

        // $perkembangan = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])->whereHas('harga_monitorings')->get()->map(function ($perkembangan) {
        //     return [
        //         'komoditas' => $perkembangan->komoditas->nama_komoditas,
        //         'harga_monitorings' => $perkembangan->harga_monitorings,
        //     ];
        // });
    }


     protected function getPerkembanganHargaData(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $pasar = $request->input('pasar');
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
}
