<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // Dashboard
            'dashboard-read',
            // Modul 1: Komoditas
            'komoditas-create',
            'komoditas-read',
            'komoditas-update',
            'komoditas-delete',
            'komoditas-view-history',

            // Modul 2: Monitoring Harga
            'harga-create',       // input harga & stok
            'harga-read',
            'harga-update',       // edit harga & stok
            'harga-delete',       // validasi dianggap sebagai delete/close
            'harga-view-history',

            // Modul 3: Laporan & Visualisasi
            'laporan-create',     // jika ada fitur buat laporan manual
            'laporan-read',       // lihat laporan seluruh wilayah
            'laporan-update',     // jika laporan bisa diubah (opsional)
            'laporan-delete',     // jika laporan bisa dihapus (opsional)
            'laporan-filter',     // filter laporan
            'laporan-download',   // download excel/pdf
            'laporan-grafik',     // lihat grafik

            // Modul 4: Manajemen User
            'user-create',        // tambah operator
            'user-read',          // lihat daftar user
            'user-update',        // edit user / profil sendiri
            'user-delete',        // hapus operator
            'user-login',         // login ke sistem
            'user-password',      // ganti password sendiri

            // Modul 5: Manajemen UPTD
            'uptd-create',
            'uptd-read',
            'uptd-update',
            'uptd-delete',

            // Modul 6: Manajemen Pasar
            'pasar-create',
            'pasar-read',
            'pasar-update',
            'pasar-delete'
        ];


        foreach ($permissions as $p) {
            Permission::create([
                'name' => $p,
                'guard_name' => 'web',

            ]);
        }
    }
}
