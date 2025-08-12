<?php

namespace Database\Seeders;

use App\Models\JenisKomoditas;
use App\Models\Komoditas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisKomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            'Cap Pandan',
            'Beras Sembako',
            'Beras Ramesia',
            'Kedelai Kalimantan',
            'Kentang Granola',
            'Kopi Arabika',
            'Sayuran Segar',
            'Buah Import',
            'Daging Sapi',
            'Telur Ayam',
            'Ikan Laut',
            'Gula Pasir',
            'Minyak Goreng',
            'Mie Sedaap',
            'Tepung Terigu',
            'Susu UHT',
            'Keju Cheddar',
            'Kacang Almond',
            'Coklat Bubuk',
            'Teh Hijau',
            'Roti Gandum',
            'Biskuit Coklat',
            'Keripik Singkong',
            'Pasta Gigi',
            'Sabun Mandi',
            'Sampo',
            'Detergen',
            'Minuman Soda',
            'Air Mineral',
            'Sereal',
            'Kacang Tanah',
            'Selai Kacang',
            'Jus Buah',
            'Coklat Batang',
            'Permen Karet',
            'Kopi Instan',
            'Teh Celup',
            'Roti Tawar',
            'Kerupuk',
            'Madu',
            'Sirup',
            'Saus Tomat',
            'Kecap Manis',
            'Bumbu Dapur',
            'Minyak Zaitun',
            'Vinegar',
            'Butter',
            'Yoghurt',
            'Ice Cream',
            'Keju Mozzarella',

        ];

        $satuan = [
            'kg',
            'ons',
            'liter',
            'bungkus',
            'botol',
            'grosir',
            'pcs',
            'sachet',
            'paket',
        ];

        $komoditas = Komoditas::all()->pluck('id')->toArray();

        foreach ($jenis as $key => $value) {
            JenisKomoditas::create([
                'komoditas_id' => $komoditas[array_rand($komoditas)],
                'nama_jenis' => $value,
                'satuan' => $satuan[array_rand($satuan)],
                'harga' => rand(1, 1000) * 1000,
            ]);
        }
    }
}
