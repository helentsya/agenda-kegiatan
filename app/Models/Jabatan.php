<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_jabatan', 'id_jabatan');
    }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }
}
