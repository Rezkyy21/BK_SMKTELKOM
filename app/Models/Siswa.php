<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'user_id',
        'nis',
        'nama',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'is_password_changed',
    ];

    protected $casts = [
        'is_password_changed' => 'boolean',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get major dari User relationship
     */
    public function major(): BelongsTo
    {
        return $this->user()->first()?->major() ?? null;
    }

    /**
     * Get class_room dari User relationship
     */
    public function classRoom()
    {
        return $this->user()->first()?->classRoom() ?? null;
    }

    /**
     * Check if siswa belum mengisi form profil pertama kali
     */
    public function needsProfileCompletion(): bool
    {
        return !$this->is_password_changed;
    }
}
