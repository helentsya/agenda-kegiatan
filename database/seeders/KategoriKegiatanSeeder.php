<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Pendidikan'],
            ['nama_kategori' => 'Pelatihan'],
            ['nama_kategori' => 'Seminar'],
            ['nama_kategori' => 'Workshop'],
            ['nama_kategori' => 'Pengabdian Masyarakat'],
            ['nama_kategori' => 'Penelitian'],
            ['nama_kategori' => 'Pengembangan Diri'],
            ['nama_kategori' => 'Lainnya'],
        ];

        foreach ($data as $kategori) {
            \App\Models\KategoriKegiatan::create($kategori);
        }
    }
}
