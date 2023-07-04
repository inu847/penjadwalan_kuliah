<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $table = 'tb_jam';
    protected $guarded = ['id'];

    public $primaryKey = 'kode_jam';
    
    protected $fillable = [
        'kode_jam',
        'start_time',
        'end_time',
    ];
}
