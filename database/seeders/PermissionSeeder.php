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
            // Modul 1: Komoditas
            'komoditas_create',
            'komoditas_read',
            'komoditas_update',
            'komoditas_delete',
            'komoditas_view_history',

            // Modul 2: Monitoring Harga
            'harga_create',       // input harga & stok
            'harga_read',
            'harga_update',       // edit harga & stok
            'harga_delete',       // validasi dianggap sebagai delete/close
            'harga_view_history',

            // Modul 3: Laporan & Visualisasi
            'laporan_create',     // jika ada fitur buat laporan manual
            'laporan_read',       // lihat laporan seluruh wilayah
            'laporan_update',     // jika laporan bisa diubah (opsional)
            'laporan_delete',     // jika laporan bisa dihapus (opsional)
            'laporan_filter',     // filter laporan
            'laporan_download',   // download excel/pdf
            'laporan_grafik',     // lihat grafik

            // Modul 4: Manajemen User
            'user_create',        // tambah operator
            'user_read',          // lihat daftar user
            'user_update',        // edit user / profil sendiri
            'user_delete',        // hapus operator
            'user_login',         // login ke sistem
            'user_password',      // ganti password sendiri

            // Modul 5: Manajemen UPTD
            'uptd_create',
            'uptd_read',
            'uptd_update',
            'uptd_delete',

            // Modul 6: Manajemen Pasar
            'pasar_create',
            'pasar_read',
            'pasar_update',
            'pasar_delete'
        ];


        foreach ($permissions as $p) {
            Permission::create([
                'name' => $p,
                'guard_name' => 'web',

            ]);
        }
    }
}
