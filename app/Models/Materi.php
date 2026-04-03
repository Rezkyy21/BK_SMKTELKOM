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

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->guru_id) && auth()->check()) {
                $model->guru_id = optional(auth()->user()->guruBk)->id;
            }

            if (empty($model->slug) && !empty($model->judul)) {
                $model->slug = \Illuminate\Support\Str::slug($model->judul) . '-' . \Illuminate\Support\Str::random(6);
            }
        });
    }
}
