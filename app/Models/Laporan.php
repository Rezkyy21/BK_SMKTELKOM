<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'booking_id',
        'guru_id',
        'catatan_sesi',
        'assessment',
        'kesimpulan',
        'rekomendasi',
        'tindak_lanjut',
        'durasi_sesi',
        'metode_konseling',
        'status',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(GuruBk::class);
    }
}
