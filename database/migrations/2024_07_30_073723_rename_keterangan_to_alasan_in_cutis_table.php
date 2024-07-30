<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenameKeteranganToAlasanInCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->string('alasan')->nullable();
        });

        DB::statement('UPDATE cutis SET alasan = keterangan');

        Schema::table('cutis', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->string('keterangan')->nullable();
        });

        DB::statement('UPDATE cutis SET keterangan = alasan');

        Schema::table('cutis', function (Blueprint $table) {
            $table->dropColumn('alasan');
        });
    }
}
