<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form (first time login).
     */
    
   public function edit(): View
{
    $siswa = auth()->user()->siswa;
    $majors = Major::all();

    // Contoh: hanya menampilkan tahun aktif saja
    $academicYears = AcademicYear::where('is_active', true)->get();

    // Contoh lain: hanya 5 tahun terakhir
    // $academicYears = AcademicYear::orderBy('name', 'desc')->take(5)->get();

    $classRooms = ClassRoom::with('major')->get();

    return view('siswa.profile.edit', compact('siswa', 'majors', 'classRooms', 'academicYears'));
}

    /**
     * Update the siswa's profile and password.
     */
    public function update(Request $request): RedirectResponse
{
   
    $siswa = auth()->user()->siswa;
    $user = auth()->user();

    $validated = $request->validate([
    'password' => ['required', 'string', 'min:8', 'confirmed'],
    'academic_year_id' => ['required', 'exists:academic_years,id'],
    'class_id' => ['required', 'exists:classes,id'],
], [
    'academic_year_id.required' => 'Tahun masuk wajib diisi',
    'academic_year_id.exists' => 'Tahun masuk tidak valid',
    'class_id.required' => 'Tahun masuk wajib diisi',
    'class_id.exists' => 'Tahun masuk tidak valid',
    'password.required' => 'Password baru wajib diisi',
    'password.min' => 'Password minimal 8 karakter',
    'password.confirmed' => 'Konfirmasi password tidak sesuai',
]);
$class = ClassRoom::find($validated['class_id']);
 $siswa->update([
    'class_id' => $validated['class_id'],
    'academic_year_id' => $validated['academic_year_id'],
    'major_id' => $class->major_id,
    'is_password_changed' => 1,
]);

    $user->update([
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('siswa.dashboard')
        ->with('success', 'Profil dan password berhasil diperbarui. Selamat datang!');
}
    public function editProfile() {
     $siswa = auth()->user()->siswa()->with('academicYear')->first();
    $majors = Major::all();
    $classRooms = ClassRoom::where('academic_year_id', AcademicYear::where('is_active', true)->first()->id)->get();

    return view('siswa.profile.edit', compact('siswa', 'majors', 'classRooms'));
    
}

}
