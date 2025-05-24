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
        Schema::create('hargakategori', function (Blueprint $table) {
            $table->id();
            $table->integer('min');     // contoh: 80000
            $table->integer('max');     // contoh: 100000
            $table->integer('nilai');   // nilai bobot untuk SAW
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hargakategori');
    }
};
