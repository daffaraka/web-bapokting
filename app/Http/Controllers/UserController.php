<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all(),
            'title' => 'Data User',
            'description' => 'Halaman ini menampilkan data user yang ada di dalam database',
            'route_create' => route('user.create'),
            'modul' => 'User'
        ];
        return view('dashboard.user.user-index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'description' => 'Halaman ini digunakan untuk menambahkan data user yang baru'
        ];
        return view('dashboard.user.user-create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 6 karakter.',

            'role.required' => 'Peran wajib dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
    }

    public function show(User $user)
    {
        $data = [
            'user' => $user,
            'title' => 'Detail User',
            'description' => 'Halaman ini menampilkan detail data user yang dipilih'
        ];
        return view('dashboard.user.user-show', $data);
    }

    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'title' => 'Edit User',
            'description' => 'Halaman ini digunakan untuk mengedit data user yang sudah ada'
        ];
        return view('dashboard.user.user-edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password harus minimal 6 karakter.',

            'role.required' => 'Peran wajib dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'role' => $request->role
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}

