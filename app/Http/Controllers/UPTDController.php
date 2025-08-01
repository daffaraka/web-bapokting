<?php

namespace App\Http\Controllers;

use App\Models\UPTD;
use Illuminate\Http\Request;

class UPTDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'uptds' => UPTD::all(),
            'title' => 'Data UPTD',
            'description' => 'Halaman ini menampilkan data UPTD yang ada di dalam database',
            'route_create' => route('uptd.create'),
            'modul' => 'UPTD'
        ];
        return view('dashboard.uptd.uptd-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah UPTD',
            'description' => 'Halaman ini digunakan untuk menambahkan data UPTD yang baru'
        ];
        return view('dashboard.uptd.uptd-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('uptd.create')
                ->withErrors($validator)
                ->withInput();
        }

        UPTD::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('uptd.index')->with('success', 'Data UPTD berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(UPTD $uptd)
    {
        $data = [
            'uptd' => $uptd,
            'title' => 'Detail UPTD',
            'description' => 'Halaman ini menampilkan detail data UPTD yang dipilih'
        ];
        return view('dashboard.uptd.uptd-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UPTD $uptd)
    {
        $data = [
            'uptd' => $uptd,
            'title' => 'Edit UPTD',
            'description' => 'Halaman ini digunakan untuk mengedit data UPTD yang sudah ada'
        ];
        return view('dashboard.uptd.uptd-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UPTD $uptd)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('uptd.edit', $uptd->id)
                ->withErrors($validator)
                ->withInput();
        }

        $uptd->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('uptd.index')->with('success', 'Data UPTD berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UPTD $uptd)
    {
        $uptd->delete();
        return redirect()->route('uptd.index')->with('success', 'Data UPTD berhasil dihapus');
    }
}
