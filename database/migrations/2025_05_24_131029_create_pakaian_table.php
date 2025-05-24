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
        Schema::create('pakaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');

            $table->foreignId('jenis_id')->constrained('jenispakaian')->onDelete('cascade');
            $table->foreignId('warna_id')->constrained('warna')->onDelete('cascade');
            $table->foreignId('lokasi_id')->constrained('lokasi')->onDelete('cascade');
            $table->foreignId('cuaca_id')->constrained('cuaca')->onDelete('cascade');
            $table->foreignId('acara_id')->constrained('jenisacara')->onDelete('cascade');
            $table->foreignId('harga_id')->constrained('hargakategori')->onDelete('cascade');

            $table->integer('harga_asli'); // harga sebenarnya, misal: 134000

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakaian');
    }
};
