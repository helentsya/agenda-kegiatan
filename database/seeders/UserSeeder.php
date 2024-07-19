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
                'id' => 1,
                'id_jabatan' => 1,
                'id_pegawai' => 1,
                'id_bidang' => 1,
                'nama_user' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('TI_Poliban'),
                'email' => 'admin@example.com',
                'roles' => 'admin'
            ],
            [
                'id' => 2,
                'id_jabatan' => 2,
                'id_pegawai' => 2,
                'id_bidang' => 1,
                'nama_user' => 'Kepala Dinas',
                'username' => 'kepaladinas',
                'password' => Hash::make('KepalaDinas'),
                'email' => 'kepaladinas@gmail.com',
                'roles' => 'kepalapejabat'
            ],
            [
                'id' => 3,
                'id_jabatan' => 3,
                'id_pegawai' => 3,
                'id_bidang' => 3,
                'nama_user' => 'Muhammad Ikhlas',
                'username' => 'kabidinfo',
                'password' => Hash::make('kabidinfo@123'),
                'email' => 'kabidinfo123@gmail.com',
                'roles' => 'pegawai'
            ],
        ]);
    }
}
