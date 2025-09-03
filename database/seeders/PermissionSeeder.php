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

            // Modul 2: Jenis Komoditas
            'jenis-komoditas-create',
            'jenis-komoditas-read',
            'jenis-komoditas-update',
            'jenis-komoditas-delete',
            'jenis-komoditas-view-history',

            // Modul 3: Monitoring Harga
            'harga-create',       // input harga & stok
            'harga-read',
            'harga-update',       // edit harga & stok
            'harga-delete',       // validasi dianggap sebagai delete/close
            'harga-view-history',

            // Modul 4: Laporan & Visualisasi
            'perkembangan-harga-create',     // jika ada fitur buat laporan manual
            'perkembangan-harga-read',       // lihat laporan seluruh wilayah
            'perkembangan-harga-update',     // jika laporan bisa diubah (opsional)
            'perkembangan-harga-delete',     // jika laporan bisa dihapus (opsional)
            'perkembangan-harga-filter',     // filter laporan
            'perkembangan-harga-download',   // download excel/pdf
            'perkembangan-harga-grafik',     // lihat grafik

            // Modul 5: Manajemen User
            'user-uptd-create',        // tambah operator
            'user-uptd-read',          // lihat daftar user
            'user-uptd-update',        // edit user / profil sendiri
            'user-uptd-delete',        // hapus operator
            'user-uptd-login',         // login ke sistem
            'user-uptd-password',      // ganti password sendiri

            // Modul 6: Manajemen UPTD
            'uptd-create',
            'uptd-read',
            'uptd-update',
            'uptd-delete',

            // Modul 7: Manajemen Pasar
            'pasar-create',
            'pasar-read',
            'pasar-update',
            'pasar-delete',


            // Modul 8: Manajemen Berita
            'berita-create',
            'berita-read',
            'berita-update',
            'berita-delete',
        ];


        foreach ($permissions as $p) {
            Permission::create([
                'name' => $p,
                'guard_name' => 'web',

            ]);
        }
    }
}
