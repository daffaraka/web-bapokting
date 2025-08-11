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
            // Modul 1: Manajemen Komoditas
            'komoditas-create',
            'komoditas-list',
            'komoditas-edit',
            'komoditas-delete',
            'komoditas-view_history',

            // Modul 2: Monitoring Harga
            'harga_create-create', // input harga & stok
            'harga_create-list',   // lihat data harga harian
            'harga_create-edit',   // edit harga & stok
            'harga_create-delete', // validasi input
            'harga_create-view_history',

            // Modul 3: Laporan & Visualisasi
            'laporan-list',        // lihat laporan seluruh wilayah
            'laporan-filter',      // filter laporan
            'laporan-download',    // download laporan
            'laporan-grafik',      // lihat grafik

            // Modul 4: Manajemen User & Hak Akses
            'user-login',
            'user-create',
            'user-list',
            'user-edit',
            'user-delete',
            'user-password',

            // Modul 5: Manajemen UPTD
            'uptd-create',
            'uptd-list',
            'uptd-edit',
            'uptd-delete',

            // Modul 6: Manajemen Pasar
            'pasar-create',
            'pasar-list',
            'pasar-edit',
            'pasar-delete'
        ];

        $opUptdPermissions = [
            // Modul 1: Manajemen Komoditas
            'komoditas-list',
            'komoditas-view_history',

            // Modul 2: Monitoring Harga
            'harga_create-create', // wilayah sendiri
            'harga_create-list',
            'harga_create-edit',   // jika belum dikunci
            'harga_create-delete', // validasi input wilayah sendiri
            'harga_create-view_history',

            // Modul 3: Laporan & Visualisasi
            'laporan-filter',
            'laporan-download',
            'laporan-grafik',

            // Modul 4: Manajemen User & Hak Akses
            'user-login',
            'user-list', // melihat profil sendiri
            'user-password',

            // Modul 5: Manajemen Pasar
            'pasar-list'
        ];


        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions($adminPermissions);


        $opUptdRole = Role::where('name', 'op_uptd')->first();
        $opUptdRole->syncPermissions($opUptdPermissions);
    }
}
