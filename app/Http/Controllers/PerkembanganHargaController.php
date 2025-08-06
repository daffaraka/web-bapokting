<?php

namespace App\Http\Controllers;

use App\Models\HargaMonitoring;
use Illuminate\Http\Request;

class PerkembanganHargaController extends Controller
{
    protected $routeCreate;


    public function __construct()
    {
        $this->routeCreate = route('perkembangan-harga.create');
    }
    public function index()
    {

        $perkembangan = HargaMonitoring::with(['komoditas','pasar','user'])->get();
        // dd($perkembangan);
        $data = [

            'title' => 'Perkembangan Harga',
            'description' => 'Halaman ini menampilkan perkembangan harga komoditas yang ada di dalam database',
            'modul' => 'Perkembangan Harga',
            'perkembanganHargas' => $perkembangan
        ];
        return view('dashboard.perkembangan-harga.perkembangan-harga-index', $data);
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
}
