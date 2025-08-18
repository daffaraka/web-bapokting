<?php

namespace App\Http\Controllers\Frontpage;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{

    public function index()
    {
        $beritas = Berita::all();
        return view('frontend.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('frontend.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Berita::create($request->all());

        return redirect()->route('berita.index')
            ->with('success', 'Berita created successfully.');
    }

    public function show(Berita $berita)
    {
        return view('frontend.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('frontend.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $berita->update($request->all());

        return redirect()->route('berita.index')
            ->with('success', 'Berita updated successfully');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita deleted successfully');
    }
}
