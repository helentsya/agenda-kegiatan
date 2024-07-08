<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'id_jabatan' => 2,
                'id_pegawai' => 2,
                'id_bidang' => 1,
                'nama_user' => 'Ani',
                'username' => 'pegawai1',
                'password' => Hash::make('pegawai1'),
                'email' => 'pegawai1@test.com',
                'roles' => 'pegawai'
            ],
            [
                'id' => 3,
                'id_jabatan' => 3,
                'id_pegawai' => 3,
                'id_bidang' => 0,
                'nama_user' => 'Cici',
                'username' => 'kepalapejabat',
                'password' => Hash::make('kepalapejabat'),
                'email' => 'pegawai2@test.com',
                'roles' => 'kepalapejabat'
            ],
            [
                'id' => 4,
                'id_jabatan' => 7,
                'id_pegawai' => 4,
                'id_bidang' => 5,
                'nama_user' => 'Andri May',
                'username' => 'andri',
                'password' => Hash::make('andri'),
                'email' => 'andri@gmail.com',
                'roles' => 'bidang'
            ],
            [
                'id' => 5,
                'id_jabatan' => 4,
                'id_pegawai' => 5,
                'id_bidang' => 1,
                'nama_user' => 'Alghi Nuub',
                'username' => 'ColonialGT',
                'password' => Hash::make('alghi'),
                'email' => 'alghi@gmail.com',
                'roles' => 'bidang'
            ],
            [
                'id' => 6,
                'id_jabatan' => 7,
                'id_pegawai' => 6,
                'id_bidang' => 1,
                'nama_user' => 'Pegawai Sekretaris',
                'username' => 'pegawaisekre',
                'password' => Hash::make('pegawaisekre'),
                'email' => 'pegawaisekre@gmail.co',
                'roles' => 'bidang'
            ],
            [
                'id' => 7,
                'id_jabatan' => 3,
                'id_pegawai' => 7,
                'id_bidang' => 1,
                'nama_user' => 'Muhammad Sumitra',
                'username' => 'kepalasekre',
                'password' => Hash::make('kepalasekre'),
                'email' => 'kepalasekre@gmail.com',
                'roles' => 'pegawai'
            ],
            [
                'id' => 8,
                'id_jabatan' => 2,
                'id_pegawai' => 9,
                'id_bidang' => 3,
                'nama_user' => 'Ismail Ahmad Kanam',
                'username' => 'kepalakomunikasi',
                'password' => Hash::make('kepalakomunikasi'),
                'email' => 'kepalakomunikasi@gmail.com',
                'roles' => 'pegawai'
            ]
        ]);
    }
}
