<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMateri extends Model
{
    protected $table = 'kategori_materi';

    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    public $timestamps = false;

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kategori_id');
    }
}
