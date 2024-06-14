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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //relasi ke tabel pegawai
            $table->foreignId('id_pegawai')->constrained('pegawais');
            $table->string('nama_user');
            $table->string('username', 50)->nullable(false);
            $table->string('password', 100)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->enum('roles', ['pegawai', 'admin', 'kepalapejabat']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
