<?php

namespace App\Http\Controllers\Frontpage;

use Carbon\Carbon;
use App\Models\Berita;
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
        // ->values();

        // dd($hargaMonitoring);



        $datasets = [];
        $primaryColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

        foreach ($hargaMonitoringData as $komoditas => $dataGroup) {
            $sorted = $dataGroup->sortBy('tanggal');
            $colorIndex = array_rand($primaryColors);
            $color = $primaryColors[$colorIndex];

            $datasets[] = [
                'label' => $komoditas,
                'borderColor' => $color,
                'pointBorderColor' => '#FFF',
                'pointBackgroundColor' => $color,
                'pointBorderWidth' => 2,
                'pointHoverRadius' => 4,
                'pointHoverBorderWidth' => 1,
                'pointRadius' => 4,
                'backgroundColor' => 'transparent',
                'fill' => true,
                'borderWidth' => 2,
                'data' => $sorted->pluck('harga')->values(),
            ];
        }



        // Ambil labels dari tanggal

        $bulanTerakhir = $hargaMonitoringData->flatten()->max('tanggal');
        $bulanTerakhirCarbon = Carbon::parse($bulanTerakhir);
        $labels = collect();

        for ($i = 1; $i <= $bulanTerakhirCarbon->month; $i++) {
            $labels->push(Carbon::create(null, $i, 1)->format('M'));
        }

        $berita = Berita::where('status', 'publish')->get();


        $data = [
            'berita' => $berita,
            'hargaMonitorings' => $hargaMonitoring,
            'labels' => $labels,
            'datasets' => $datasets,
        ];
        return view('frontend.index');
    }

    public function profilBapokting()
    {
        return view('frontend.profil-bapokting');
    }
}
