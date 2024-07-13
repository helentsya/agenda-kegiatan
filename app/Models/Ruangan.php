<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_agenda',
        'nama_ruangan',
        'kapasitas',
        'status_ruang',
        'hari',
        'tanggal',
        'durasi_pemakaian'
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'id_ruangan');
    }
}