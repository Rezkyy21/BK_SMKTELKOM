<?php

namespace App\Http\Controllers;

use App\Models\CareerPlan;
use App\Models\User;
use Illuminate\Http\Request;

class CareerPlanController extends Controller
{
    /**
     * Tampilkan form input rencana karir.
     * Hanya untuk siswa kelas 12.
     */
    public function edit()
    {
        $user = auth()->user();

        // Cek apakah user adalah siswa
        if ($user->role !== 'siswa') {
            return redirect()
                ->route('siswa.karir')
                ->with('error', 'Hanya siswa yang dapat mengakses halaman ini.');
        }

        // Load relasi jika belum
        $user->load(['classRoom', 'major', 'careerPlan']);

        // Cek apakah siswa ada di kelas 12
        if (!$user->classRoom || $user->classRoom->grade_level !== 12) {
            return redirect()
                ->route('siswa.karir')
                ->with('warning', 'Fitur rencana karir hanya tersedia untuk siswa kelas 12.');
        }

        // Ambil atau buat career plan jika belum ada
        $careerPlan = $user->careerPlan ?? new CareerPlan();

        return view('siswa.career-plan-form', [
            'careerPlan' => $careerPlan,
            'user' => $user,
        ]);
    }

    /**
     * Simpan atau update rencana karir.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi user adalah siswa
        if ($user->role !== 'siswa') {
            abort(403, 'Unauthorized');
        }

        // Validasi input berdasarkan kategori
        $rules = [
            'category' => 'required|in:kuliah,kerja,usaha,lainnya',
            'description' => 'nullable|string|max:1000',
            'target_university' => 'nullable|string|max:255',
            'target_major' => 'nullable|string|max:255',
            'target_company' => 'nullable|string|max:255',
            'target_position' => 'nullable|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'business_idea' => 'nullable|string|max:1000',
        ];

        // tambahkan kolom-kolom kuliah jika kategori kuliah
        if ($request->input('category') === 'kuliah') {
            $rules = array_merge($rules, [
                'student_name' => 'nullable|string|max:255',
                'nis' => 'nullable|string|max:50',
                'class_name' => 'nullable|string|max:100',
                'graduation_year' => 'nullable|integer',
                'campus_name' => 'nullable|string|max:255',
                'study_program' => 'nullable|string|max:255',
                'entrance_year' => 'nullable|integer',
            ]);
        } elseif ($request->input('category') === 'kerja') {
            $rules = array_merge($rules, [
                'student_name' => 'nullable|string|max:255',
                'nis' => 'nullable|string|max:50',
                'class_name' => 'nullable|string|max:100',
                'graduation_year' => 'nullable|integer',
                'target_company' => 'nullable|string|max:255',
                'target_position' => 'nullable|string|max:255',
                'accepted_year' => 'nullable|integer',
            ]);
        } elseif ($request->input('category') === 'usaha') {
            $rules = array_merge($rules, [
                'student_name' => 'nullable|string|max:255',
                'nis' => 'nullable|string|max:50',
                'class_name' => 'nullable|string|max:100',
                'graduation_year' => 'nullable|integer',
                'business_type' => 'nullable|string|max:255',
                'business_name' => 'nullable|string|max:255',
                'established_year' => 'nullable|integer',
                'business_idea' => 'nullable|string|max:1000',
            ]);
        }

        $validated = $request->validate($rules);

        // Ambil atau buat career plan baru
        $careerPlan = $user->careerPlan ?? new CareerPlan();
        $careerPlan->user_id = $user->id;

        // Update field berdasarkan kategori
        $careerPlan->category = $validated['category'];
        $careerPlan->description = $validated['description'] ?? null;

        // Reset field khusus sebelum update
        $careerPlan->target_university = null;
        $careerPlan->target_major = null;
        $careerPlan->target_company = null;
        $careerPlan->target_position = null;
        $careerPlan->business_name = null;
        $careerPlan->business_idea = null;

        // Update field berdasarkan kategori pilihan
        // Reset semua kolom khusus terlebih dahulu
        $careerPlan->student_name = null;
        $careerPlan->nis = null;
        $careerPlan->class_name = null;
        $careerPlan->graduation_year = null;
        $careerPlan->campus_name = null;
        $careerPlan->study_program = null;
        $careerPlan->entrance_year = null;
        $careerPlan->target_university = null;
        $careerPlan->target_major = null;
        $careerPlan->target_company = null;
        $careerPlan->target_position = null;
        $careerPlan->business_name = null;
        $careerPlan->business_idea = null;

        match ($validated['category']) {
            'kuliah' => [
                $careerPlan->student_name = $validated['student_name'] ?? null,
                $careerPlan->nis = $validated['nis'] ?? null,
                $careerPlan->class_name = $validated['class_name'] ?? null,
                $careerPlan->graduation_year = $validated['graduation_year'] ?? null,
                $careerPlan->campus_name = $validated['campus_name'] ?? null,
                $careerPlan->study_program = $validated['study_program'] ?? null,
                $careerPlan->entrance_year = $validated['entrance_year'] ?? null,
                $careerPlan->target_university = $validated['target_university'] ?? null,
                $careerPlan->target_major = $validated['target_major'] ?? null,
            ],
            'kerja' => [
                $careerPlan->student_name = $validated['student_name'] ?? null,
                $careerPlan->nis = $validated['nis'] ?? null,
                $careerPlan->class_name = $validated['class_name'] ?? null,
                $careerPlan->graduation_year = $validated['graduation_year'] ?? null,
                $careerPlan->target_company = $validated['target_company'] ?? null,
                $careerPlan->target_position = $validated['target_position'] ?? null,
                $careerPlan->accepted_year = $validated['accepted_year'] ?? null,
            ],
            'usaha' => [
                $careerPlan->student_name = $validated['student_name'] ?? null,
                $careerPlan->nis = $validated['nis'] ?? null,
                $careerPlan->class_name = $validated['class_name'] ?? null,
                $careerPlan->graduation_year = $validated['graduation_year'] ?? null,
                $careerPlan->business_type = $validated['business_type'] ?? null,
                $careerPlan->business_name = $validated['business_name'] ?? null,
                $careerPlan->established_year = $validated['established_year'] ?? null,
                $careerPlan->business_idea = $validated['business_idea'] ?? null,
            ],
            default => null,
        };

        $careerPlan->save();

        return redirect()
            ->route('siswa.karir')
            ->with('success', 'Rencana karir berhasil disimpan!');
    }

    /**
     * Submit rencana karir ke guru BK.
     */
    public function submit(Request $request)
    {
        $user = auth()->user();

        $careerPlan = $user->careerPlan;

        if (!$careerPlan) {
            return redirect()
                ->back()
                ->with('error', 'Belum ada rencana karir untuk disubmit.');
        }

        $careerPlan->status = 'submitted';
        $careerPlan->submitted_at = now();
        $careerPlan->save();

        return redirect()
            ->route('siswa.karir')
            ->with('success', 'Rencana karir berhasil disubmit ke guru BK!');
    }
}
