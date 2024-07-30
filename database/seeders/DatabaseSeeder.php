<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BidangSeeder::class,
            PegawaiSeeder::class,
            KategoriKegiatanSeeder::class,
            JabatanSeeder::class,
            JatahCutiSeeder::class,
        ]);

        //buat 3 user dengan role admin 1 dan pegawai 2
        \App\Models\User::create([
            'id_pegawai' => 1,
            'nama_user' => 'Budi',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'email' => 'admin@test.com',
            'roles' => 'admin'
        ]);

        \App\Models\User::create([
            'id_pegawai' => 2,
            'nama_user' => 'Ani',
            'username' => 'pegawai1',
            'password' => bcrypt('12345678'),
            'email' => 'pegawai1@test.com',
            'roles' => 'pegawai'
        ]);

        \App\Models\User::create([
            'id_pegawai' => 3,
            'nama_user' => 'Cici',
            'username' => 'kepalapejabat',
            'password' => bcrypt('12345678'),
            'email' => 'pegawai2@test.com',
            'roles' => 'kepalapejabat'
        ]);
    }
}
