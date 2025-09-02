<?php

namespace App\Http\Controllers\Frontpage;

use Carbon\Carbon;
use App\Models\Pasar;
use App\Models\Berita;
use App\Models\Komoditas;
use Illuminate\Http\Request;
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
        $title = 'Barang Pokok';
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
        return view('frontend.barang-pokok', compact('barangPenting'));
    }

    public function hargaPerPasar()
    {
        $hargaPerPasar = Pasar::with(['hargaMonitoring'])->get();

        return view('frontend.harga-per-pasar', compact('hargaPerPasar'));
    }
}
