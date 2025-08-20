<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HargaMonitoring;

class HargaMonitoringController extends Controller
{
    protected $routeCreate;


    public function __construct()
    {
        $this->routeCreate = route('harga-monitoring.create');
    }
    public function index()
    {

        $count = HargaMonitoring::count();
        $limit = $count > 5 ? 5 : $count;
        $hargaMonitoring  = HargaMonitoring::with(['jenis_komoditas', 'pasar', 'user']);

        $availKomoditas = $hargaMonitoring->clone()->distinct('jenis_komoditas_id')->get('jenis_komoditas_id','jenis_komoditas.nama_jenis');

        // dd($availKomoditas[0]);
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
        //    dd($labels);

        $data = [
            'title' => 'Monitoring Harga',
            'description' => 'Halaman ini menampilkan monitoring harga komoditas yang ada di dalam database',
            'modul' => 'Monitoring Harga',
            'hargaMonitorings' => $hargaMonitoring,
            'labels' => $labels,
            'datasets' => $datasets,
            'availKomoditas' => $availKomoditas

        ];

        return view('dashboard.monitoring-komoditas.monitoring-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(HargaMonitoring $hargaMonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HargaMonitoring $hargaMonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HargaMonitoring $hargaMonitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HargaMonitoring $hargaMonitoring)
    {
        //
    }
}
