<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pegawai',
        'jenis_cuti',
        'mulai_cuti',
        'lama_cuti',
        'keterangan',
        'is_approved'
    ];

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
}
