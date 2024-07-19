<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            [
                'id' => 1,
                'id_jabatan' => 0,
                'id_bidang' => 0,
                'nip' => '0',
                'nama_pegawai' => 'Admin',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '1991-01-01',
                'jabatan' => 'Admin',
                'alamat' => 'Jl. Jendral Sudirman'
            ],
            [
                'id' => 2,
                'id_jabatan' => 1,
                'id_bidang' => 1,
                'nip' => '00000',
                'nama_pegawai' => 'Kepala Dinas',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '1996-01-01',
                'jabatan' => 'Kepala Dinas',
                'alamat' => 'Jl. Jendral Sudirman'
            ],
            [
                'id' => 3,
                'id_jabatan' => 3,
                'id_bidang' => 3,
                'nip' => '0003',
                'nama_pegawai' => 'Muhammad Ikhlas',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Banjarmasin',
                'tanggal_lahir' => '1995-01-01',
                'jabatan' => 'Kepala Bidang Informatika',
                'alamat' => 'Gambut'
            ],
        ]);
    }
}
