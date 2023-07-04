<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_kelas';
    protected $guarded = ['id'];

    public $primaryKey = 'kode_kelas';

    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'jumlah_mahasiswa',
    ];
}
