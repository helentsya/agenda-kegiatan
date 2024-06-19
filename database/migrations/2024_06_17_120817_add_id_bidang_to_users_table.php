<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdBidangToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bidang')->nullable()->after('id_pegawai'); // Tambahkan kolom id_bidang setelah kolom email

            // // Jika terdapat tabel `bidang` yang berhubungan, bisa tambahkan foreign key constraint
            // $table->foreign('id_bidang')->references('id')->on('bidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_bidang');
        });
    }
}
