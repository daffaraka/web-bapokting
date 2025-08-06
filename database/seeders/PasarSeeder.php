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
            ['nama' => 'Pasar A', 'lokasi' => 'Lokasi A', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar B', 'lokasi' => 'Lokasi B', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar C', 'lokasi' => 'Lokasi C', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar D', 'lokasi' => 'Lokasi D', 'uptd_id' => $uptd[3]['id']],
            ['nama' => 'Pasar E', 'lokasi' => 'Lokasi E', 'uptd_id' => $uptd[4]['id']],
            ['nama' => 'Pasar F', 'lokasi' => 'Lokasi F', 'uptd_id' => $uptd[5]['id']],
            ['nama' => 'Pasar G', 'lokasi' => 'Lokasi G', 'uptd_id' => $uptd[6]['id']],
            ['nama' => 'Pasar H', 'lokasi' => 'Lokasi H', 'uptd_id' => $uptd[7]['id']],
            ['nama' => 'Pasar I', 'lokasi' => 'Lokasi I', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar J', 'lokasi' => 'Lokasi J', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar K', 'lokasi' => 'Lokasi K', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar L', 'lokasi' => 'Lokasi L', 'uptd_id' => $uptd[3]['id']],
            ['nama' => 'Pasar M', 'lokasi' => 'Lokasi M', 'uptd_id' => $uptd[4]['id']],
            ['nama' => 'Pasar N', 'lokasi' => 'Lokasi N', 'uptd_id' => $uptd[5]['id']],
            ['nama' => 'Pasar O', 'lokasi' => 'Lokasi O', 'uptd_id' => $uptd[6]['id']],
            ['nama' => 'Pasar P', 'lokasi' => 'Lokasi P', 'uptd_id' => $uptd[7]['id']],
            ['nama' => 'Pasar Q', 'lokasi' => 'Lokasi Q', 'uptd_id' => $uptd[0]['id']],
            ['nama' => 'Pasar R', 'lokasi' => 'Lokasi R', 'uptd_id' => $uptd[1]['id']],
            ['nama' => 'Pasar S', 'lokasi' => 'Lokasi S', 'uptd_id' => $uptd[2]['id']],
            ['nama' => 'Pasar T', 'lokasi' => 'Lokasi T', 'uptd_id' => $uptd[3]['id']],
        ];

        foreach ($pasars as $pasar) {
            Pasar::create($pasar);
        }

    }
}
