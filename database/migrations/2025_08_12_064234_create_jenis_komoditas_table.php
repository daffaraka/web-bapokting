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
        Schema::create('jenis_komoditas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komoditas_id')->constrained()->onDelete('cascade');
            $table->string('nama_jenis');
            $table->bigInteger('harga');
            $table->string('satuan')->nullable(); // contoh: kg, liter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_komoditas');
    }
};
