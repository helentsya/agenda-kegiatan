<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            ['id_jabatan' => 1, 'nama_jabatan' => 'Admin'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Kepala Dinas'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Kepala Bidang Sekretariat'],
            ['id_jabatan' => 4, 'nama_jabatan' => 'Kepala Bidang Informatika'],
            ['id_jabatan' => 5, 'nama_jabatan' => 'Kepala Bidang Komunikasi'],
            ['id_jabatan' => 6, 'nama_jabatan' => 'Kepala Bidang Statistika Persandian'],
            ['id_jabatan' => 7, 'nama_jabatan' => 'Pegawai Bidang Sekretariat'],
            ['id_jabatan' => 8, 'nama_jabatan' => 'Pegawai Bidang Informatika'],
            ['id_jabatan' => 9, 'nama_jabatan' => 'Pegawai Bidang Komunikasi'],
            ['id_jabatan' => 10, 'nama_jabatan' => 'Pegawai Bidang Statistika Persandian'],
        ];

        foreach ($jabatans as $jabatan) {
            DB::table('jabatans')->insert($jabatan);
        }
    }
}
