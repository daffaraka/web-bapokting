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
        $hargaMonitoring  = HargaMonitoring::with(['komoditas', 'pasar', 'user']);

        $availKomoditas = $hargaMonitoring->clone()->distinct('komoditas_id')->get('komoditas_id','komoditas.nama');

        // dd($availKomoditas);
        $hargaMonitoringData = $hargaMonitoring->clone()->get()
            ->groupBy('komoditas.nama')
            ->sortByDesc(function ($group) {
                return $group->count();
            })->take($limit);
        // ->values();

        // dd($hargaMonitoring);



        $datasets = [];

        foreach ($hargaMonitoringData as $komoditas => $dataGroup) {

            // dd($komoditas);
            $sorted = $dataGroup->sortBy('tanggal');

            $datasets[] = [
                'label' => $komoditas,
                'borderColor' => '#' . substr(md5(uniqid(mt_rand(), true)), 0, 6),
                'pointBorderColor' => '#FFF',
                'pointBackgroundColor' => '#' . substr(md5(uniqid(mt_rand(), true)), 0, 6),
                'pointBorderWidth' => 2,
                'pointHoverRadius' => 4,
                'pointHoverBorderWidth' => 1,
                'pointRadius' => 4,
                // 'backgroundColor' => '#' . substr(md5(uniqid(mt_rand(), true)), 0, 6) . '8c',
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
