<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pegawai',
        'cuti_tahunan',
        'cuti_besar',
        'cuti_sakit',
        'cuti_melahirkan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
