<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $table = 'bidangs';
    protected $fillable = ['nama_bidang'];
    public function events()
    {
        return $this->hasMany(Event::class, 'id_bidang');
    }
}
