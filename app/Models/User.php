<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;

    // columns that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status_akun',
        'avatar',
        // added for academic tracking
        'major_id',
        'class_id',
        'tahun_masuk',
        'status', // aktif or lulus
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
            'tahun_masuk' => 'integer',
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

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }

    // Relasi ke model akademik

    /**
     * Siswa memiliki jurusan.
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Siswa berada dalam sebuah kelas (ClassRoom).
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    // existing relations for BK domain
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function guruBk()
    {
        return $this->hasOne(GuruBk::class, 'user_id');
    }

    /**
     * Siswa dapat memiliki rencana karir (terutama untuk kelas 12).
     */
    public function careerPlan()
    {
        return $this->hasOne(CareerPlan::class, 'user_id');
    }

    /**
     * Hitung selisih tahun antara tahun sekarang dengan tahun masuk.
     * Berguna untuk penentuan kenaikan kelas.
     *
     * @return int
     */
    public function yearsEnrolled(): int
    {
        if (! $this->tahun_masuk) {
            return 0;
        }

        return now()->year - (int) $this->tahun_masuk;
    }

    /**
     * Perbarui status dan/atau kelas siswa berdasarkan tahun masuk.
     * dipanggil oleh command atau proses cron.
     */
    public function promoteIfNecessary(): void
    {
        $years = $this->yearsEnrolled();

        if ($years >= 3) {
            // setelah tiga tahun dianggap lulus
            $this->status = 'lulus';
            $this->class_id = null; // tidak lagi terikat kelas
            $this->save();
            return;
        }

        // apabila masih aktif, cari kelas yang sesuai.
        $newGrade = 10 + $years;
        if ($this->classRoom && $this->classRoom->grade_level == $newGrade) {
            // tidak perlu perubahan
            return;
        }

        // asumsikan kelas untuk jurusan/grade/tahun akademik sudah ada
        // Find active academic year and lookup by academic_year_id
        $activeYear = \App\Models\AcademicYear::where('is_active', true)->first();
        $targetClass = null;
        if ($activeYear) {
            $targetClass = ClassRoom::where('major_id', $this->major_id)
                ->where('grade_level', $newGrade)
                ->where('academic_year_id', $activeYear->id)
                ->first();
        }

        if ($targetClass) {
            $this->class_id = $targetClass->id;
            $this->save();
        }
    }

}
