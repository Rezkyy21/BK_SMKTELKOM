<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $table = "topik";
    public $timestamps = false;
    
    protected $fillable = [
        'nama_topik',
        'deskripsi',
        'is_active',
    ];
}


