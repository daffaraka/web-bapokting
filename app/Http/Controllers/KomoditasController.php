<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomoditasController extends Controller
{

        protected $routeCreate;


    public function __construct()
    {
        $this->routeCreate = route('komoditas.create');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'komoditas' => Komoditas::all(),
            'title' => 'Data Komoditas',
            'description' => 'Halaman ini menampilkan data komoditas yang ada di dalam database',
            'route_create' => $this->routeCreate,
            'modul' => 'Komoditas'
        ];
        return view('dashboard.komoditas.komoditas-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Komoditas',
            'description' => 'Halaman ini digunakan untuk menambahkan data komoditas yang baru'
        ];
        return view('dashboard.komoditas.komoditas-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'jenis' => 'required|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|max:255'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'jenis.required' => 'Jenis wajib diisi.',
            'jenis.max' => 'Jenis tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('komoditas.create')
                ->withErrors($validator)
                ->withInput();
        }

        Komoditas::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('komoditas.index')->with('success', 'Data komoditas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komoditas $komoditas)
    {
        $data = [
            'komoditas' => $komoditas,
            'title' => 'Detail Komoditas',
            'description' => 'Halaman ini menampilkan detail data komoditas yang dipilih'
        ];
        return view('dashboard.komoditas.komoditas-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komoditas $komoditas)
    {
        $data = [
            'komoditas' => $komoditas,
            'title' => 'Edit Komoditas',
            'description' => 'Halaman ini digunakan untuk mengedit data komoditas yang sudah ada'
        ];
        return view('dashboard.komoditas.komoditas-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komoditas $komoditas)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'jenis' => 'required|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|max:255'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'jenis.required' => 'Jenis wajib diisi.',
            'jenis.max' => 'Jenis tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('komoditas.edit', $komoditas->id)
                ->withErrors($validator)
                ->withInput();
        }

        $komoditas->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('komoditas.index')->with('success', 'Data komoditas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komoditas $komoditas)
    {
        $oldKomoditas = $komoditas->nama;
        $komoditas->delete();
        return redirect()->route('komoditas.index')->with('success', 'Data komoditas : '.$oldKomoditas.' berhasil dihapus');
    }
}
