<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'op_uptd']);

        $adminPermissions = [

            // Modul 1: Dashboard
            'dashboard-read',

            // Modul 2: Komoditas
            'komoditas-create',
            'komoditas-read',
            'komoditas-update',
            'komoditas-delete',
            'komoditas-view-history',

            // Modul 3: Jenis Komoditas
            'jenis-komoditas-create',
            'jenis-komoditas-read',
            'jenis-komoditas-update',
            'jenis-komoditas-delete',
            'jenis-komoditas-view-history',

            // Modul 4: Monitoring Harga
            'harga-create', // input harga & stok
            'harga-read',
            'harga-update', // edit harga & stok
            'harga-delete', // validasi dianggap sebagai delete/close
            'harga-view-history',

            // Modul 5: Laporan & Visualisasi
            'perkembangan-harga-create', // jika ada fitur buat laporan manual
            'perkembangan-harga-read', // lihat laporan seluruh wilayah
            'perkembangan-harga-update', // jika laporan bisa diubah (opsional)
            'perkembangan-harga-delete', // jika laporan bisa dihapus (opsional)
            'perkembangan-harga-filter', // filter laporan
            'perkembangan-harga-download', // download excel/pdf
            'perkembangan-harga-grafik', // lihat grafik

            // Modul 6: Manajemen User
            'user-uptd-create', // tambah operator
            'user-uptd-read', // lihat daftar user
            'user-uptd-update', // edit user / profil sendiri
            'user-uptd-delete', // hapus operator
            'user-uptd-password', // ganti password sendiri

            // Modul 7: Manajemen UPTD
            'uptd-create',
            'uptd-read',
            'uptd-update',
            'uptd-delete',

            // Modul 8: Manajemen Pasar
            'pasar-create',
            'pasar-read',
            'pasar-update',
            'pasar-delete',

            // Modul 9: Manajemen Berita
            'berita-create',
            'berita-read',
            'berita-update',
            'berita-delete',
        ];

        $opUptdPermissions = [
            // Modul 1: Dashboard
            'dashboard-read',

            // Modul 2: Komoditas
            'komoditas-read',
            'komoditas-view-history',
            'komoditas-update',

            // Modul 3: Jenis Komoditas
            'jenis-komoditas-read',
            'jenis-komoditas-update',

            // Modul 4: Monitoring Harga
            'harga-create', // wilayah sendiri
            'harga-read',
            'harga-update', // jika belum dikunci
            'harga-delete', // validasi input wilayah sendiri
            'harga-view-history',

            // Modul 5: Laporan & Visualisasi
            'perkembangan-harga-create',
            'perkembangan-harga-read', // lihat laporan seluruh wilayah\
            'perkembangan-harga-filter',
            'perkembangan-harga-download',
            'perkembangan-harga-grafik',

            // Modul 6: Manajemen Pasar
            // 'pasar-read',

            'user-uptd-create',        // tambah operator
            'user-uptd-read',          // lihat daftar user
            'user-uptd-update',        // edit user / profil sendiri
            'user-uptd-delete',        // hapus operator
            'user-uptd-login',         // login ke sistem
            'user-uptd-password',      // ganti password sendiri

        ];


        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions($adminPermissions);


        $opUptdRole = Role::where('name', 'op_uptd')->first();
        $opUptdRole->syncPermissions($opUptdPermissions);
    }
}

