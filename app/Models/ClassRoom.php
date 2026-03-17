<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Major;
use App\Models\User;
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
    ];


   
    public function getFullNameAttribute()
    {
        return $this->grade_level . ' ' . $this->major->name . ' ' . $this->name;
    }
    /**
     * Each class belongs to a major (jurusan).
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
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