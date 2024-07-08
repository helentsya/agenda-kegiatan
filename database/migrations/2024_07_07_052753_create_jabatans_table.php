<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatansTable extends Migration
{
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('nama_jabatan');
            $table->timestamps();
        });

        // Menambah kolom id_jabatan ke tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jabatan')->nullable()->after('id');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('set null');
        });

        // Menambah kolom id_jabatan ke tabel pegawais
        Schema::table('pegawais', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jabatan')->nullable()->after('id');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);
            $table->dropColumn('id_jabatan');
        });

        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);
            $table->dropColumn('id_jabatan');
        });

        Schema::dropIfExists('jabatans');
    }
}
