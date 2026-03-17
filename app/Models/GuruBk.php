<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuruBk extends Model
{
    protected $table = "guru_bk";

    protected $fillable = [
        'user_id',
        'photo',
        'nip',
        'nama',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'guru_id');
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class, 'guru_id');
    }

    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class, 'guru_id');
    }
}





