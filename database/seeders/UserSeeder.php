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

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password'
        ]);

        $admin->assignRole('admin');

        for ($i=1; $i <= 3; $i++) {
            $user = User::factory()->create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => 'password'
            ]);

            $user->assignRole('admin');
        }


        for ($i=1; $i <= 7; $i++) {
           $uptd =  User::factory()->create([
                'name' => 'UPTD ' . $i,
                'email' => 'uptd' . $i . '@example.com',
                'password' => 'password'
            ]);

            $uptd->assignRole('op_uptd');
        }
    }
}
