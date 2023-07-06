<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = 'tb_penjadwalan';
    protected $guarded = ['id'];

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'matkul_id',
        'dosen_id',
        'kelas_id',
        'ruang_id',
    ];
    
    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'kode_dosen');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'kode_kelas');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'kode_ruang');
    }
}
