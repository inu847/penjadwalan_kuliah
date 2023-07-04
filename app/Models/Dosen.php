<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'tb_dosen';
    public $primaryKey = 'kode_dosen';

    protected $fillable = [
        'kode_dosen',
        'nidn',
        'nama_dosen',
    ];
    
    public function matkul()
    {
        return $this->hasMany(Matkul::class);
    }
}
