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
       $classRooms = ClassRoom::with('major')->get();
        
        return view('siswa.profile.edit', compact('siswa', 'majors', 'classRooms'));
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
        'tahun_masuk' => ['required', 'digits:4', 'integer', 'min:2000', 'max:' . date('Y')],
        'class_id' => ['required', 'exists:classes,id'],
    ], [
        'major_id.required' => 'Jurusan wajib diisi',
        'major_id.exists' => 'Jurusan tidak valid',
        'password.required' => 'Password baru wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak sesuai',
        'tahun_masuk.required' => 'Tahun masuk wajib diisi',
        'tahun_masuk.digits' => 'Tahun masuk harus 4 digit (mis. 2023)',
        'tahun_masuk.integer' => 'Tahun masuk tidak valid',
        'tahun_masuk.max' => 'Tahun masuk tidak boleh lebih besar dari tahun sekarang',
    ]);

  $siswa->update([
   
    'class_id' => $request->class_id, 
    'tahun_masuk' => $validated['tahun_masuk'],
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
