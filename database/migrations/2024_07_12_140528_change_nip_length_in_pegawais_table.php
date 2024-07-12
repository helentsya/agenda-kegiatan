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
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('nip', 18)->change(); // Mengubah tipe data nip menjadi string dengan panjang 18 karakter
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Pastikan tipe data sesuai dengan tipe data sebelumnya
            $table->integer('nip')->change(); // Mengembalikan tipe data nip menjadi integer
        });
    }
};
