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
        for ($i = 0; $i < 10; $i++) {

            UPTD::create([
                'nama' => 'UPTD ' . $i
            ]);
        }
    }
}
