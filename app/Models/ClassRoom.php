<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Major;
use App\Models\User;
use App\Models\GuruBk;
use App\Models\AcademicYear;

class ClassRoom extends Model
{
    use HasFactory;

    // name of the table is "classes" which is not the plural of ClassRoom, so we explicitly specify it.
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'grade_level',
        'major_id',
        'academic_year_id',
        'guru_id',
    ];

    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute()
{
    $grade = match ((int) $this->grade_level) {
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
        default => $this->grade_level,
    };

    return $grade . ' ' . $this->major->name . ' ' . $this->name;
}
    /**
     * Each class belongs to a major (jurusan).
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    

     public function guru()
    {
        return $this->belongsTo(GuruBK::class, 'guru_id'); // relasi FK
    }

    /**
     * Each class belongs to an academic year.
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    /**
     * Students assigned to this class.
     */
    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}