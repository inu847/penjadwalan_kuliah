<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'tb_ruang';
    protected $guarded = ['id'];
    
    public $primaryKey = 'kode_ruang';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas',
        'jenis',
    ];
}
