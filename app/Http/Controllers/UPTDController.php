<?php

namespace App\Http\Controllers;

use App\Models\UPTD;
use App\Models\User;
use App\Models\Pasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UPTDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'uptds' => UPTD::with('users')->get(),
            'title' => 'Data User & UPTD',
            'description' => 'Halaman ini menampilkan data UPTD yang ada di dalam database',
            'route_create' => route('user-uptd.create'),
            'modul' => 'User & UPTD'
        ];

        // dd($data['uptds']);
        return view('dashboard.uptd.uptd-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User dan UPTD Baru',
            'description' => 'Halaman ini digunakan untuk menambahkan data User dan UPTD yang baru',
            'pasar' => Pasar::whereDoesntHave('uptd')->get(),
        ];
        return view('dashboard.uptd.uptd-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_uptd' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ], [
            'nama_uptd.required' => 'Nama UPTD wajib diisi.',
            'nama_uptd.max' => 'Nama UPTD tidak boleh lebih dari 255 karakter.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 6 karakter.',
            'role.required' => 'Jbatan wajib dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user-uptd.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        if ($user) {
            UPTD::create([
                'nama_uptd' => $request->nama_uptd,
                'user_id' => $user->id
            ]);
        }



        return redirect()->route('user-uptd.index')->with('success', 'Data User dan UPTD baru berhasil ditambahkan');
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
            'uptd' => $uptd->load('pasars'),
            'pasar' => Pasar::whereDoesntHave('uptds')->get(),
            'title' => 'Edit UPTD',
            'description' => 'Halaman ini digunakan untuk mengedit data UPTD yang sudah ada'
        ];

        // dd($data['pasar']);
        return view('dashboard.uptd.uptd-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UPTD $uptd)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_uptd' => 'required|max:255'
        ], [
            'nama_uptd.required' => 'Nama UPTD wajib diisi.',
            'nama_uptd.max' => 'Nama UPTD tidak boleh lebih dari 255 karakter.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user-uptd.edit', $uptd->id)
                ->withErrors($validator)
                ->withInput();
        }

        $uptd->update([
            'nama_uptd' => $request->nama_uptd
        ]);

        $uptd->pasars()->delete();


        for ($i = 1; $i <= count($request->pasar_id); $i++) {
            $uptd->pasars()->create([
                'pasar_id' => $request->pasar_id[$i]
            ]);
        }

        return redirect()->route('user-uptd.index')->with('success', 'Data UPTD berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UPTD $uptd)
    {
        $uptd->delete();
        return redirect()->route('user-uptd.index')->with('success', 'Data UPTD berhasil dihapus');
    }
}
