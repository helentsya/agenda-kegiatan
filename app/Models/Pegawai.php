<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bidang',
        'nip',
        'nama_pegawai',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'jabatan',
        'alamat'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_pegawai');
    }
}