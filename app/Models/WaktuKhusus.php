<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuKhusus extends Model
{
    use HasFactory;

    protected $table = 'tb_waktukhusus';
    protected $guarded = ['id'];

    public $primaryKey = 'kode_waktukhusus';
    protected $fillable = [
        'kode_waktukhusus',
        'kode_dosen',
        'day',
        'status',
        'start_time',
        'end_time',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'kode_dosen', 'kode_dosen');
    }
}
