<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bidang')->after('id_pegawai')->nullable();
            $table->foreign('id_bidang')->references('id')->on('bidangs')->onDelete('cascade');
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
            $table->dropForeign(['id_bidang']);
            $table->dropColumn('id_bidang');
        });
    }
};
