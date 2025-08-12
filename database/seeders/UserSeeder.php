<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);

        for ($i=1; $i <= 3; $i++) {
            User::factory()->create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => 'password'
            ]);
        }


        for ($i=1; $i <= 7; $i++) {
            User::factory()->create([
                'name' => 'UPTD ' . $i,
                'email' => 'uptd' . $i . '@example.com',
                'password' => 'password'
            ]);
        }
    }
}
