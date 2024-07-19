<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_bidang' => 'Admin',
            ],
            [
                'nama_bidang' => 'Bidang Sekretariat',
            ],
            [
                'nama_bidang' => 'Bidang Informatika',
            ],
            [
                'nama_bidang' => 'Bidang Komunikasi',
            ],
            [
                'nama_bidang' => 'Bidang Statistika Persandian',
            ],
        ];

        foreach ($data as $bidang) {
            \App\Models\Bidang::create($bidang);
        }
    }
}
