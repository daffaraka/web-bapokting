<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();                                          // id standar
            $table->string('judul_berita');                        // Judul berita
            $table->string('slug_berita')->unique();               // Slug unik untuk URL
            $table->longText('konten_berita');                     // Isi berita (rich editor)
            $table->string('gambar_berita')->nullable();           // Thumbnail / cover berita
            $table->unsignedBigInteger('user_id');                 // Penulis berita (relasi ke users)
            $table->enum('status_berita', ['draft', 'published'])->default('draft'); // Status berita
            $table->timestamp('published_at')->nullable();  // Waktu publikasi
            $table->timestamps();

            // Foreign Key ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
