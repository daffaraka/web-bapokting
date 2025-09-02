<?php

namespace App\Http\Controllers;

use App\Models\UPTD;
use App\Models\User;
use App\Models\Pasar;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use App\Models\JenisKomoditas;
use App\Models\HargaMonitoring;

class DashboardController extends Controller
{
    public function index()
    {

        $user = User::count();
        $admin = User::role('admin')->count();
        $op_uptd = User::role('op_uptd')->count();
        $komoditas = Komoditas::count();
        $hargaMonitoring = HargaMonitoring::count();
        $pasar = Pasar::count();
        $jenisKomoditas = JenisKomoditas::count();
        $uptd = UPTD::count();


        $data = [
            'user' => $user,
            'admin' => $admin,
            'op_uptd' => $op_uptd,
            'komoditas' => $komoditas,
            'hargaMonitoring' => $hargaMonitoring,
            'pasar' => $pasar,
            'jenisKomoditas' => $jenisKomoditas,
            'uptd' => $uptd,

            'title' => 'Dashboard',
            'description' => 'Halaman ini menampilkan dashboard yang berisi informasi data pengguna, monitoring harga, dan data pasar',
            'modul' => 'Dashboard',
            // 'route_create' =>
            // 'perkembangan_harga' =>
        ];
        return view('dashboard', $data);
    }
}
