<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'tb_matkul';
    protected $guarded = ['id'];

    protected $fillable = [
        'kode_matkul',
        'id',
        'nama_matkul',
        'sks',
        'semester',
        'jenis',
        'kurikulum',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
