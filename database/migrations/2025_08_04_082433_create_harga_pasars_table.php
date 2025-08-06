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
        Schema::create('harga_pasars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasar_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('harga_monitoring_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_pasars');
    }
};
