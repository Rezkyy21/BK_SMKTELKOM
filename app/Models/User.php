<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status_akun',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Filament
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->role === 'admin' || $this->role === 'guru_bk';
    }

    public function getFilamentName(): string
    {
        return $this->name ?? $this->email;
    }

    // Relasi
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function guruBk()
    {
        return $this->hasOne(GuruBk::class, 'user_id');
    }
}
