<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasar;
use App\Models\Komoditas;
use App\Models\HargaMonitoring;
use App\Models\HargaPasar;
use App\Models\JenisKomoditas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HargaMonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komoditas = JenisKomoditas::all()->pluck('id')->toArray();
        $pasar = Pasar::all()->pluck('id')->toArray();
        $user = User::all()->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            HargaMonitoring::create([
                'jenis_komoditas_id' => $komoditas[array_rand($komoditas)],
                'pasar_id' => $pasar[array_rand($pasar)],
                'user_id' => $user[array_rand($user)],
                'harga' => rand(1, 1000) * 1000 / 10,
                'tanggal' => now()->subDays(rand(0, now()->dayOfYear - 1))->format('Y-m-d'),
                'stok' => rand(10, 1000),

            ]);
        }
    }
}
