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
        'major_id',
        'class_id',
        'jenis_kelamin',
        'alamat',
        'academic_year_id', 
        'is_password_changed',
    ];

    protected $casts = [
        'is_password_changed' => 'boolean',
    ];
    public function getFullKelasAttribute()
        {
            return 
                ($this->kelas->grade_level ?? '-') . ' ' .
                ($this->major->name ?? '-') . ' ' .
                ($this->kelas->name ?? '-');
        }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
    
    public function kelas()
{
    return $this->belongsTo(ClassRoom::class, 'class_id');
}
 public function academicYear() {
    return $this->belongsTo(AcademicYear::class, 'academic_year_id'); 
}

    public function needsProfileCompletion(): bool
    {
        return !$this->is_password_changed;
    }
}