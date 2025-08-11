<?php

namespace Database\Seeders;

use App\Models\UPTD;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UPTDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $daftarUptd = [
            'Setu-Cibitung & Sukatani',
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
                'nama' => 'UPTD '.$namaUptd
            ]);
        }
    }
}
