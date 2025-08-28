<?php

namespace Database\Seeders;

use App\Models\UPTD;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UPTDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::all()->pluck('id')->toArray();
        $daftarUptd = [
            'Setu',
            'Cibitung',
            'Sukatani',
            'Cibarusah',
            'Tambun',
            'Serang',
            'Cikarang & Pertokoan',
            'Babelan',
            'Tarumajaya',
            'KD.Gede',
        ];
        foreach ($daftarUptd as $namaUptd) {
            UPTD::create([
                'nama_uptd' => 'UPTD '.$namaUptd,
                'user_id' => $user[array_rand($user)]
            ]);
        }
    }
}
