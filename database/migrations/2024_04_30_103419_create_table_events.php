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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_kegiatans');
            $table->foreignId('id_ruangan')->constrained('ruangans');
            $table->integer('id_bidang');
            $table->string('title');
            $table->string('dihadiri');
            $table->string('pakaian');
            $table->string('keterangan');
            // $table->date('tanggal');
            $table->dateTime('start_event');
            $table->dateTime('end_event')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
