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
        Schema::create('penilaian_pakaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pakaian_id')->constrained('pakaians')->onDelete('cascade'); // FIX di sini
            $table->foreignId('sub_kriteria_id')->constrained('sub_kriterias')->onDelete('cascade');
            $table->integer('nilai'); // 1 kalau cocok, 0 kalau tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_pakaians');
    }
};
