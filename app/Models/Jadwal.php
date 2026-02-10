<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal";
    public $timestamps = false;

    protected $fillable = [
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'is_active',
    ];

    /**
     * Get the guru that owns the jadwal.
     */
    public function guru()
    {
        return $this->belongsTo(GuruBk::class, 'guru_id');
    }
}

