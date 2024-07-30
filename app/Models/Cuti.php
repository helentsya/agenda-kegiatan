<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pegawai',
        'id_bidang',
        'jenis_cuti',
        'mulai_cuti',
        'akhir_cuti',
        'lama_cuti',
        'alasan',
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

    public static function rules($request)
    {
        $rules = [
            'jenis_cuti' => 'required|string',
            'mulai_cuti' => 'required|date',
            'akhir_cuti' => 'required|date|after_or_equal:mulai_cuti',
            'alasan' => 'required|string',
        ];

        switch ($request->jenis_cuti) {
            case 'cuti tahunan':
                $rules['akhir_cuti'] .= '|before_or_equal:' . Carbon::parse($request->mulai_cuti)->addDays(12)->format('Y-m-d');
                break;
            case 'cuti besar':
                $rules['akhir_cuti'] .= '|before_or_equal:' . Carbon::parse($request->mulai_cuti)->addDays(30)->format('Y-m-d');
                break;
            case 'cuti sakit':
                $rules['akhir_cuti'] .= '|before_or_equal:' . Carbon::parse($request->mulai_cuti)->addDays(10)->format('Y-m-d');
                break;
            case 'cuti melahirkan':
                $rules['akhir_cuti'] .= '|before_or_equal:' . Carbon::parse($request->mulai_cuti)->addDays(90)->format('Y-m-d');
                break;
        }

        return $rules;
    }
}
