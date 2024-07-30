<?php

namespace Database\Seeders;

use App\Models\JatahCuti;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JatahCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pegawai::all()->each(function ($pegawai) {
            JatahCuti::create([
                'id_pegawai' => $pegawai->id,
                'cuti_tahunan' => 12,
                'cuti_besar' => 30,
                'cuti_sakit' => 10,
                'cuti_melahirkan' => 90
            ]);
        });
    }
}
