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

            'dashboard-read',
            // Modul 1: Komoditas
            'komoditas-create',
            'komoditas-read',
            'komoditas-update',
            'komoditas-delete',
            'komoditas-view-history',

            // Modul 2: Monitoring Harga
            'harga-create', // input harga & stok
            'harga-read',
            'harga-update', // edit harga & stok
            'harga-delete', // validasi dianggap sebagai delete/close
            'harga-view-history',

            // Modul 3: Laporan & Visualisasi
            'laporan-create', // jika ada fitur buat laporan manual
            'laporan-read', // lihat laporan seluruh wilayah
            'laporan-update', // jika laporan bisa diubah (opsional)
            'laporan-delete', // jika laporan bisa dihapus (opsional)
            'laporan-filter', // filter laporan
            'laporan-download', // download excel/pdf
            'laporan-grafik', // lihat grafik

            // Modul 4: Manajemen User
            'user-create', // tambah operator
            'user-read', // lihat daftar user
            'user-update', // edit user / profil sendiri
            'user-delete', // hapus operator
            'user-login', // login ke sistem
            'user-password', // ganti password sendiri

            // Modul 5: Manajemen UPTD
            'uptd-create',
            'uptd-read',
            'uptd-update',
            'uptd-delete',

            // Modul 6: Manajemen Pasar
            'pasar-create',
            'pasar-read',
            'pasar-update',
            'pasar-delete',

            // Modul 8  : Manajemen Berita
            'berita-create',
            'berita-read',
            'berita-update',
            'berita-delete',
        ];

        $opUptdPermissions = [
            'dashboard-read',
            // Modul 1: Komoditas
            'komoditas-read',
            'komoditas-view-history',

            // Modul 2: Monitoring Harga
            'harga-create', // wilayah sendiri
            'harga-read',
            'harga-update', // jika belum dikunci
            'harga-delete', // validasi input wilayah sendiri
            'harga-view-history',

            // Modul 3: Laporan & Visualisasi
            'laporan-filter',
            'laporan-download',
            'laporan-grafik',

            // Modul 4: Manajemen User
            'user-login',
            'user-read', // melihat profil sendiri
            'user-password',

            // Modul 5: Manajemen Pasar
            'pasar-read'
        ];


        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions($adminPermissions);


        $opUptdRole = Role::where('name', 'op_uptd')->first();
        $opUptdRole->syncPermissions($opUptdPermissions);
    }
}
