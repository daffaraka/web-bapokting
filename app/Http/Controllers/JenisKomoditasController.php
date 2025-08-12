<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKomoditas;
use App\Models\Komoditas;
use Illuminate\Support\Facades\Validator;

class JenisKomoditasController extends Controller
{
    protected $routeCreate;



    public function __construct()
    {
        $this->routeCreate = route('jenis-komoditas.create');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'komoditas' => JenisKomoditas::with('komoditas')->get(),
            'title' => 'Data Jenis Komoditas',
            'description' => 'Halaman ini menampilkan data jenis komoditas yang ada di dalam database',
            'route_create' => $this->routeCreate,
            'modul' => 'Jenis Komoditas'
        ];
        return view('dashboard.jenis-komoditas.jenis-komoditas-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Jenis Komoditas',
            'description' => 'Halaman ini digunakan untuk menambahkan data jenis komoditas yang baru',
            'komoditas' => Komoditas::all()
        ];
        return view('dashboard.jenis-komoditas.jenis-komoditas-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis' => 'required|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|max:255'
        ], [
            'nama_jenis.required' => 'Nama Jenis wajib diisi.',
            'nama_jenis.max' => 'Nama Jenis tidak boleh lebih dari 255 karakter.',
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

        JenisKomoditas::create([
            'nama' => $request->nama,
            'nama_jenis' => $request->jenis,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('komoditas.index')->with('success', 'Data komoditas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKomoditas $jenisKomoditas)
    {
        $data = [
            'komoditas' => $jenisKomoditas,
            'title' => 'Detail Komoditas',
            'description' => 'Halaman ini menampilkan detail data komoditas yang dipilih'
        ];
        return view('dashboard.jenis-komoditas.jenis-komoditas-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKomoditas $jenisKomoditas)
    {
        $data = [
            'komoditas' => $jenisKomoditas,
            'title' => 'Edit Komoditas',
            'description' => 'Halaman ini digunakan untuk mengedit data jenis komoditas yang sudah ada',
            'komoditas' => Komoditas::all()

        ];
        return view('dashboard.jenis-komoditas.jenis-komoditas-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKomoditas $jenisKomoditas)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis' => 'required|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|max:255'
        ], [
            'nama_jenis.required' => 'Nama Jenis wajib diisi.',
            'nama_jenis.max' => 'Nama Jenis tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('komoditas.edit', $jenisKomoditas->id)
                ->withErrors($validator)
                ->withInput();
        }

        $jenisKomoditas->update([
            'nama' => $request->nama,
            'nama_jenis' => $request->jenis,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('komoditas.index')->with('success', 'Data komoditas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKomoditas $jenisKomoditas)
    {
        $oldKomoditas = $jenisKomoditas->nama;
        $jenisKomoditas->delete();
        return redirect()->route('komoditas.index')->with('success', 'Data komoditas : ' . $oldKomoditas . ' berhasil dihapus');
    }
}
