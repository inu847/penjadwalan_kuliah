<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    use HasFactory;

    protected $table = 'tb_pengampu';
    protected $guarded = ['id'];
    public $primaryKey = 'kode_pengampu';

    protected $fillable = [
        'kode_pengampu',
        'tahun_akademik',
        'matkul_id',
        'dosen_id',
        'kelas_id',
    ];
    

    public function matakuliah()
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

}
