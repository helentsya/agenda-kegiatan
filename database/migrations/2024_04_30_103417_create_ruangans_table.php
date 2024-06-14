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
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_agenda')->constrained('events');
            $table->string('nama_ruangan');
            // $table->string('kode_ruang');
            // $table->string('keterangan');
            $table->string('kapasitas');
            // $table->string('foto_ruang');
            $table->enum('status_ruang', ['tersedia', 'tidak tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
