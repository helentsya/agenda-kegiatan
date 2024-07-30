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
        Schema::create('jatah_cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pegawai')->constrained('pegawais')->onDelete('cascade');
            $table->integer('cuti_tahunan')->default(12)->nullable();
            $table->integer('cuti_besar')->default(30)->nullable();
            $table->integer('cuti_sakit')->default(10)->nullable();
            $table->integer('cuti_melahirkan')->default(90)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jatah_cutis');
    }
};
