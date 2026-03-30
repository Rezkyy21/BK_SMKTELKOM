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

    $activeYear = AcademicYear::where('is_active', true)->first();
    $academicYears = AcademicYear::orderBy('start_year', 'desc')->get();

    $classRooms = ClassRoom::with('major')->get();

    return view('siswa.profile.edit', compact('siswa', 'majors', 'classRooms', 'academicYears', 'activeYear'));
}

    /**
     * Update the siswa's profile and password.
     */
    public function update(Request $request): RedirectResponse
{
   
    $siswa = auth()->user()->siswa;
    $user = auth()->user();

    $validated = $request->validate([
        'email' => ['nullable', 'email', 'unique:users,email,' . auth()->id()],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'academic_year_id' => ['required', 'exists:academic_years,id'],
    ], [
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'academic_year_id.required' => 'Tahun masuk wajib diisi',
        'academic_year_id.exists' => 'Tahun masuk tidak valid',
        'password.required' => 'Password baru wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak sesuai',
    ]);
    $siswa->update([
        'academic_year_id' => $validated['academic_year_id'],
        'is_password_changed' => 1,
    ]);

    $userData = [
        'password' => Hash::make($validated['password']),
        'tahun_masuk' => AcademicYear::find($validated['academic_year_id'])->start_year ?? $user->tahun_masuk,
    ];

    if (!empty($validated['email'])) {
        $userData['email'] = $validated['email'];
    }

    $user->update($userData);

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
