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
        Schema::table('ruangans', function (Blueprint $table) {
            $table->string('hari')->nullable()->after('status_ruang');
            $table->date('tanggal')->nullable()->after('hari');
            $table->integer('durasi_pemakaian')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->dropColumn('hari');
            $table->dropColumn('tanggal');
            $table->dropColumn('durasi_pemakaian');
        });
    }
};
