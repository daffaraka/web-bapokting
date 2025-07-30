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
        Schema::create('harga_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasar_id')->constrained()->onDelete('cascade');
            $table->foreignId('komoditas_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // operator yang input
            $table->date('tanggal');
            $table->decimal('harga', 10, 2);
            $table->integer('stok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_komoditas');
    }
};
