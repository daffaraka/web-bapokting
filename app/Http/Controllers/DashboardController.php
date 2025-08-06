<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {



        $data = [


            'title' => 'Dashboard',
            'description' => 'Halaman ini menampilkan dashboard yang berisi informasi data pengguna, monitoring harga, dan data pasar',
            'modul' => 'Dashboard',
            // 'route_create' =>
            // 'perkembangan_harga' =>
        ];
        return view('dashboard',$data);
    }
}
