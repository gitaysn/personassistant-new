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
        Schema::create('pakaian_sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pakaian_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_kriteria_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['pakaian_id', 'sub_kriteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakaian_sub_kriterias');
    }
};
