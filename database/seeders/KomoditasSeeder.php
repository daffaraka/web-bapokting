<?php

namespace Database\Seeders;

use App\Models\Komoditas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     */
    public function run(): void
    {
        $komoditas = [
            'Kedelai',
            'Cabe merah',
            'Gula',
            'Minyak goreng',
            'Beras',
            'Daging sapi',
            'Telur',
            'Susu kental manis',
            'Susu bubuk',
            'Jagung pipilan',
            'Garam beryodium',
            'Tepung terigu',
            'Cabe rawit',
            'Bawang merah',
            'Bawang putih',
            'Bawang Bombay',
            'Ikan asin teri',
            'Ikan kembung',
            'Kacang hijau',
            'Kacang tanah',
            'Ketela pohon',
            'Kentang',
            'Ikan bandeng',
            'Ikan tongkol',
            'Tempe',
            'Tahu mentah',
            'Daging ayam',
            'Tomat',
            'Ikan mas',
            'Ikan lele'
        ];

        $satuan = [
            'kg',
            'ons',
            'liter'
        ];


        $jenisKomoditas = [
            'Komoditas Pertanian',
            'Komoditas Energi',
            'Komoditas Logam',
            'Komoditas Peternakan',
            'Komoditas Perdagangan',
            'Komoditas Keras',
            'Komoditas Lunak'
        ];


        for ($i = 0; $i < count($komoditas); $i++) {
            Komoditas::create([
                'nama' => $komoditas[$i],
                'satuan' => $satuan[array_rand($satuan)],
                'jenis' => $jenisKomoditas[array_rand($jenisKomoditas)],
                'harga' => rand(1, 1000) * 1000 / 10,
            ]);
        }
    }
}
