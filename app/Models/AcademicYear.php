<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_year',
        'end_year',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_year' => 'integer',
        'end_year' => 'integer',
    ];

    /**
     * Classes in this academic year.
     */
    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'academic_year_id');
    }

    /**
     * Scope to get active academic year.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->first();
    }

    /**
     * Boot the model.
     * Ensure only one academic year is active at a time.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // If setting this year as active, deactivate all others
            if ($model->is_active && ($model->isDirty('is_active'))) {
                DB::transaction(function () use ($model) {
                    // Deactivate all other years
                    static::query()
                        ->where('id', '!=', $model->id ?? 0)
                        ->update(['is_active' => false]);
                });
            }
        });
    }

    /**
     * Set this academic year as active and deactivate others.
     */
    public function activate()
    {
        DB::transaction(function () {
            // Deactivate all others
            static::query()
                ->where('id', '!=', $this->id)
                ->update(['is_active' => false]);

            // Activate this one
            $this->update(['is_active' => true]);
        });
    }
}
