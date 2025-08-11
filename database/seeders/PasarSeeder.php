<?php

namespace Database\Seeders;

use App\Models\UPTD;
use App\Models\Pasar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uptd = UPTD::all()->toArray();
        $pasars = [
            ['nama' => 'Pasar A', 'lokasi' => 'Bandung', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar B', 'lokasi' => 'Jakarta', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar C', 'lokasi' => 'Surabaya', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar D', 'lokasi' => 'Malang', 'uptd_id' => $uptd[3]['id']],
            ['nama' => 'Pasar E', 'lokasi' => 'Semarang', 'uptd_id' => $uptd[4]['id']],
            ['nama' => 'Pasar F', 'lokasi' => 'Yogyakarta', 'uptd_id' => $uptd[5]['id']],
            ['nama' => 'Pasar G', 'lokasi' => 'Solo', 'uptd_id' => $uptd[6]['id']],
            ['nama' => 'Pasar H', 'lokasi' => 'Makassar', 'uptd_id' => $uptd[7]['id']],
            ['nama' => 'Pasar I', 'lokasi' => 'Bandar Lampung', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar J', 'lokasi' => 'Medan', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar K', 'lokasi' => 'Palembang', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar L', 'lokasi' => 'Pontianak', 'uptd_id' => $uptd[3]['id']],
            ['nama' => 'Pasar M', 'lokasi' => 'Banjarmasin', 'uptd_id' => $uptd[4]['id']],
            ['nama' => 'Pasar N', 'lokasi' => 'Balikpapan', 'uptd_id' => $uptd[5]['id']],
            ['nama' => 'Pasar O', 'lokasi' => 'Manado', 'uptd_id' => $uptd[6]['id']],
            ['nama' => 'Pasar P', 'lokasi' => 'Jayapura', 'uptd_id' => $uptd[7]['id']],
            ['nama' => 'Pasar Q', 'lokasi' => 'Denpasar', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar R', 'lokasi' => 'Mataram', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar S', 'lokasi' => 'Kupang', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar T', 'lokasi' => 'Ambon', 'uptd_id' => $uptd[3]['id']],
        ];

        foreach ($pasars as $pasar) {
            Pasar::create($pasar);
        }

    }
}
