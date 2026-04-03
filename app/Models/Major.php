<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ClassRoom;
use App\Models\User;

class Major extends Model
{
    use HasFactory;

    // table name is "majors" by default
    protected $fillable = ['name'];

    /**
     * A major can have many classes (kelas) associated with it.
     */
    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'major_id');
    }

    /**
     * Optionally, we can list the users (siswa) enrolled in this major.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'major_id');
    }
}