<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'siswa_id', 'guru_id', 'booking_id',
        'nama_siswa', 'nis', 'kelas', 'jenis_kelamin',
        'topik', 'jadwal',
        'durasi', 'metode_konseling', 'nama_guru',
        'catatan_sesi', 'diagnosis', 'tindakan',
        'kesimpulan', 'tindak_lanjut',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(GuruBk::class, 'guru_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
