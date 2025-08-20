<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ManajemenBeritaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Berita',
            'description' => 'Halaman ini digunakan untuk menampilkan data Berita',
            'beritas' => Berita::with('user')->latest()->get(),
            'modul' => 'Berita',
            'route_create' => route('berita.create')
        ];
        return view('dashboard.berita.berita-index', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Tambah Berita',
            'description' => 'Halaman ini digunakan untuk menambahkan data Berita yang baru',
        ];
        return view('dashboard.berita.berita-create', $data);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'judul_berita' => 'required',
            'slug_berita' => 'required',
            'konten_berita' => 'required',
            'gambar_berita' => 'required',
            'status_berita' => 'required',
        ]);

        $file = $request->file('gambar_berita');
        $fileName = $file->getClientOriginalName();
        $time = now()->format('Y-m-d H-i-s');
        $fileName = $time . '-' . $fileName;
        $savedPath = $request->judul_berita . '-' . $fileName;


        // dd($savedPath);
        $file->move('berita', $savedPath);


        $published_at = $request->status_berita == 'published' ? now() : null;

        Berita::create([
            'judul_berita' => $request->judul_berita,
            'slug_berita' => $request->slug_berita,
            'konten_berita' => $request->konten_berita,
            'gambar_berita' => 'berita/' . $savedPath,
            'user_id' => Auth::user()->id,
            'status_berita' => $request->status_berita,
            'published_at' => $published_at,
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita created successfully.');
    }

    public function show(Berita $berita)
    {

        // dd($berita);
        $data = [
            'title' => 'Detail Berita',
            'description' => 'Halaman ini digunakan untuk menampilkan detail Berita',
            'berita' => $berita
        ];
        return view('dashboard.berita.berita-show', $data);
    }

    public function edit(Berita $berita)
    {
        $data = [
            'title' => 'Edit Berita',
            'description' => 'Halaman ini digunakan untuk memperbarui Berita',
            'berita' => $berita
        ];
        return view('dashboard.berita.berita-edit', $data);
    }

    public function update(Request $request, Berita $berita)
    {

        dd($request->all());
        $published_at = $request->status_berita == 'published' ? now() : $berita->published_at;


        if ($request->has('gambar_berita')) {
            $file = $request->file('gambar_berita');
            $fileName = $file->getClientOriginalName();
            $time = now('Y-m-d H-i-s');
            $fileName = $time . '-' . $fileName;
            $savedPath = $request->judul_berita . '-' . $fileName;

            if (File::exists('berita/' . $berita->gambar_berita)) {
                File::delete('berita/' . $berita->gambar_berita);
                $file->move('berita', $savedPath);
            } else {
                $file->move('berita', $savedPath);
            }
        } else {
            $savedPath = $berita->gambar_berita;
        }


        $berita->update([
            'judul_berita' => $request->judul_berita,
            'slug_berita' => $request->slug_berita,
            'konten_berita' => $request->konten_berita,
            'gambar_berita' => $savedPath,
            'user_id' => Auth::user()->id,
            'status_berita' => $request->status_berita,
            'published_at_berita' => $published_at,
        ]);

        // dd($berita);

        return redirect()->route('berita.index')
            ->with('success', 'Berita updated successfully');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.berita-index')
            ->with('success', 'Berita deleted successfully');
    }
}
