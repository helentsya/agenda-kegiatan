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
                'id' => 2,
                'id_jabatan' => 4,
                'id_bidang' => 2,
                'nip' => '987654321',
                'nama_pegawai' => 'Ani',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1991-01-01',
                'jabatan' => 'Staff',
                'alamat' => 'Jl. Jendral Sudirman'
            ],
            [
                'id' => 3,
                'id_jabatan' => 2,
                'id_bidang' => 3,
                'nip' => '123123123',
                'nama_pegawai' => 'Cici',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1992-01-01',
                'jabatan' => 'Staff',
                'alamat' => 'Jl. Jendral Sudirman'
            ],
            [
                'id' => 4,
                'id_jabatan' => 3,
                'id_bidang' => 5,
                'nip' => '123321',
                'nama_pegawai' => 'Andri May',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Marabahan',
                'tanggal_lahir' => '2024-06-14',
                'jabatan' => 'Pegawai',
                'alamat' => 'Marabahan'
            ],
            [
                'id' => 5,
                'id_jabatan' => 4,
                'id_bidang' => 2,
                'nip' => '123',
                'nama_pegawai' => 'Alghi Nuub',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Bbjb',
                'tanggal_lahir' => '2003-02-22',
                'jabatan' => 'HRD',
                'alamat' => 'Bbjb'
            ],
            [
                'id' => 6,
                'id_jabatan' => 7,
                'id_bidang' => 4,
                'nip' => '3021',
                'nama_pegawai' => 'Pegawai Sekretaris',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Rantau',
                'tanggal_lahir' => '2005-01-13',
                'jabatan' => 'Pegawai Sekretaris',
                'alamat' => 'Bjb'
            ],
            [
                'id' => 7,
                'id_jabatan' => 3,
                'id_bidang' => 1,
                'nip' => '1',
                'nama_pegawai' => 'Muhammad Sumitra',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Banjarbaru',
                'tanggal_lahir' => '2013-01-09',
                'jabatan' => 'Kepala Bidang',
                'alamat' => 'Banjarbaru'
            ],
            [
                'id' => 8,
                'id_jabatan' => 3,
                'id_bidang' => 3,
                'nip' => '6969',
                'nama_pegawai' => 'Ismail Ahmad Kanam',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Banjarbaru',
                'tanggal_lahir' => '2002-05-29',
                'jabatan' => 'Kepala Bidang Informatika',
                'alamat' => 'Banjarbaru'
            ]
        ]);
    }
}
