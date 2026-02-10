<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'kategori_id',
        'guru_id',
        'judul',
        'slug',
        'konten',
        'thumbnail',
        'status',
        'published_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriMateri::class, 'kategori_id');
    }

    public function guru()
    {
        return $this->belongsTo(GuruBk::class, 'guru_id');
    }
}
