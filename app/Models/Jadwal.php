<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get the bookings for this jadwal.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'jadwal_id');
    }
}

