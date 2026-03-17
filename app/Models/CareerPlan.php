<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'student_name',
        'nis',
        'class_name',
        'graduation_year',
        'campus_name',
        'study_program',
        'entrance_year',
        'accepted_year',
        'business_type',
        'established_year',
        'description',
        'target_university',
        'target_major',
        'target_company',
        'target_position',
        'business_name',
        'business_idea',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
    
    /**
     * Relasi ke User (siswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ambil label kategori dalam bahasa Indonesia.
     */
    public function getCategoryLabel(): string
    {
        return match ($this->category) {
            'kuliah' => 'Melanjutkan Kuliah',
            'kerja' => 'Bekerja',
            'usaha' => 'Membuka Usaha',
            'lainnya' => 'Lainnya',
            default => 'Tidak Dipilih',
        };
    }

    /**
     * Ambil deskripsi rencana berdasarkan kategori.
     */
    public function getDetailDescription(): string
    {
        return match ($this->category) {
            'kuliah' => "Target Universitas: {$this->target_university} | Program: {$this->target_major}",
            'kerja' => "Target Perusahaan: {$this->target_company} | Posisi: {$this->target_position}",
            'usaha' => "Usaha: {$this->business_name}",
            'lainnya' => $this->description ?? 'Belum ada detail',
            default => 'Belum ada rencana',
        };
    }
}
