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
        Schema::table('cutis', function (Blueprint $table) {
            //
            $table->dropColumn('lama_cuti');
            $table->date('akhir_cuti')->nullable()->after('mulai_cuti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cutis', function (Blueprint $table) {
            //
            $table->dropColumn('akhir_cuti');
            $table->integer('lama_cuti')->nullable();
        });
    }
};
