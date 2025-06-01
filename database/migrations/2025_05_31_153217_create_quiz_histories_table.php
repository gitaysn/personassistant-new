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
        Schema::create('quiz_histories', function (Blueprint $table) {
            $table->id();
            $table->json('jenis_acara');    // multiple
            $table->string('harga');        // single
            $table->string('jenis_pakaian');// single
            $table->json('warna');          // multiple
            $table->json('lokasi');         // multiple
            $table->json('hasil_rekomendasi'); // bisa menyimpan lebih dari 1 hasil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_histories');
    }
};
