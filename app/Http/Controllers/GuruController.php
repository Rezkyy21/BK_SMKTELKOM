<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CareerPlan;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Redirect guru to Filament admin panel.
     */
    public function dashboard()
    {
        // Redirect guru ke admin panel Filament
        return redirect('/admin');
    }

    /**
     * Tampilkan data rencana karir siswa untuk guru BK.
     */
    public function studentCareerPlans(Request $request)
    {
        // Cek apakah user adalah guru BK
        if (auth()->user()->role !== 'guru_bk') {
            abort(403, 'Hanya guru BK yang dapat mengakses halaman ini.');
        }

        $query = CareerPlan::with(['user', 'user.classRoom', 'user.major'])
            ->whereHas('user', function ($q) {
                $q->where('status', 'aktif')
                  ->where('role', 'siswa');
            });

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan grade level
        if ($request->filled('grade')) {
            $query->whereHas('user.classRoom', function ($q) {
                $q->where('grade_level', request()->grade);
            });
        }

        // Filter berdasarkan search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $careerPlans = $query->paginate(15);

        return view('guru.student-career-plans', [
            'careerPlans' => $careerPlans,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Tampilkan detail rencana karir seorang siswa.
     */
    public function viewStudentCareerPlan($studentId)
    {
        // Cek apakah user adalah guru BK
        if (auth()->user()->role !== 'guru_bk') {
            abort(403, 'Unauthorized');
        }

        $student = User::with(['careerPlan', 'classRoom', 'major'])->findOrFail($studentId);

        if (!$student->careerPlan) {
            abort(404, 'Rencana karir siswa tidak ditemukan.');
        }

        return view('guru.student-career-plan-detail', [
            'student' => $student,
            'careerPlan' => $student->careerPlan,
        ]);
    }
}
