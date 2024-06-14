<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_bidang' => 1,
                'nama_pegawai' => 'Budi',
                'nip' => '123456789',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'jabatan' => 'Kepala Bagian',
                'alamat' => 'Jl. Jendral Sudirman No. 1',
            ],
            [
                'id_bidang' => 2,
                'nama_pegawai' => 'Ani',
                'nip' => '987654321',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1991-01-01',
                'jabatan' => 'Staff',
                'alamat' => 'Jl. Jendral Sudirman No. 2',
            ],
            [
                'id_bidang' => 3,
                'nama_pegawai' => 'Cici',
                'nip' => '123123123',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1992-01-01',
                'jabatan' => 'Staff',
                'alamat' => 'Jl. Jendral Sudirman No. 3',
            ]
        ];

        foreach ($data as $pegawai) {
            \App\Models\Pegawai::create($pegawai);
        }
    }
}
