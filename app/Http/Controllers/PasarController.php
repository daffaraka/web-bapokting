<?php

namespace App\Http\Controllers;

use App\Models\UPTD;
use App\Models\Pasar;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Pasar',
            'description' => 'Halaman ini digunakan untuk menampilkan data Pasar',
            'pasars' => Pasar::with('uptd')->latest()->get(),
            'modul' => 'Pasar',
            'route_create' => route('pasar.create'),
            'create_permission' => 'pasar-create'
        ];

        return view('dashboard.pasar.pasar-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Pasar',
            'description' => 'Halaman ini digunakan untuk menambahkan data Pasar yang baru',
            'uptd' => UPTD::all(),

        ];
        return view('dashboard.pasar.pasar-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            // 'uptd_id' => 'required',
        ], [
            'nama.required' => 'Nama Pasar harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
            'uptd_id.required' => 'UPTD harus diisi',
        ]);

        $pasar = new Pasar();
        $pasar->nama = $request->nama;
        $pasar->lokasi = $request->lokasi;
        $pasar->uptd_id = $request->uptd_id;
        $pasar->save();

        return redirect()->route('pasar.index')->with('success', 'Data Pasar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasar $pasar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasar $pasar)
    {
        $data = [
            'title' => 'Edit Pasar',
            'description' => 'Halaman ini digunakan untuk mengubah data Pasar',
            'uptd' => UPTD::all(),
            'pasar' => $pasar
        ];


        return view('dashboard.pasar.pasar-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasar $pasar)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
            'uptd_id' => 'required',
        ], [
            'nama.required' => 'Nama Pasar harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
            'uptd_id.required' => 'UPTD harus diisi',
        ]);


        $pasar->nama = $request->nama;
        $pasar->lokasi = $request->lokasi;
        $pasar->uptd_id = $request->uptd_id;
        $pasar->save();


        return redirect()->route('pasar.index')->with('success', 'Data Pasar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasar $pasar)
    {
        $pasar->delete();
        return redirect()->route('pasar.index')->with('success', 'Data Pasar berhasil dihapus');
    }
}
