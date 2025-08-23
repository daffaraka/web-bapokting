<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');

        $gambarBerita = array_diff(scandir(public_path('berita')), ['..', '.']);

        $user = User::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $status = $faker->boolean() ? 'draft' : 'published';
            $judul  = $faker->sentence(6);

            $konten = <<<HTML
        <h2>{$judul}</h2>
        <p><strong>{$judul}</strong> — {$faker->sentence()}.</p>
        <p>{$faker->paragraph(3)}</p>
        <h3>{$faker->words(3, true)}</h3>
        <ul>
            <li>{$faker->sentence()}</li>
            <li>{$faker->sentence()}</li>
            <li>{$faker->sentence()}</li>
        </ul>
        <blockquote>{$faker->sentence(12)}</blockquote>
        <p>{$faker->paragraph(2)}</p>
    HTML;

            Berita::create([
                'judul_berita'  => $judul,
                'slug_berita'   => Str::slug($judul),
                'konten_berita' => $konten,
                'gambar_berita' => 'berita/'.$gambarBerita[array_rand($gambarBerita)],
                'user_id'       => $user[array_rand($user)],
                'status_berita' => $status,
                'published_at'  => $status === 'published'
                    ? $faker->dateTimeBetween('-10 days', 'now')
                    : null,
            ]);
        }
    }
}

