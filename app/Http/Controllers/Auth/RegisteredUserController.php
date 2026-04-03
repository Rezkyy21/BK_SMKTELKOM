<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Major;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Ambil data majors, classes dan academic year aktif untuk dropdown
        $majors = Major::whereIn('name', ['RPL', 'TKJ', 'TJA'])->get();
        $classes = ClassRoom::all();
        $activeYear = AcademicYear::where('is_active', true)->first();

        return view('auth.register', compact('majors', 'classes', 'activeYear'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $nis = substr($request->email, 0, strpos($request->email, '@'));

        $request->validate([
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[0-9]+@student\.smktelkom-pwt\.sch\.id$/'
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama' => ['required', 'string', 'max:255'],
            'major_id' => ['required', 'exists:majors,id'],
            // class_id is optional now because user may type manual name
            'class_id' => ['nullable', 'exists:classes,id'],
            'class_manual' => ['nullable', 'string', 'max:255'],
            'tahun_masuk' => ['required', 'integer', 'min:2020', 'max:' . now()->year],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ], [
            'major_id.required' => 'Pilih jurusan terlebih dahulu',
            'major_id.exists' => 'Jurusan yang dipilih tidak valid',
            'class_id.required_if' => 'Pilih kelas atau ketik nama kelas',
            'class_id.exists' => 'Kelas yang dipilih tidak valid',
            'class_manual.max' => 'Nama kelas terlalu panjang',
            'tahun_masuk.required' => 'Tahun masuk wajib diisi',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka',
            'tahun_masuk.min' => 'Tahun masuk minimal 2020',
            'tahun_masuk.max' => 'Tahun masuk tidak boleh lebih dari tahun sekarang',
        ]);

        // Determine class_id: either selected or create/find manual entry
        $classId = $request->class_id;
        if (!$classId && $request->class_manual) {
            // create or retrieve class record for the major and active academic year
            $activeYear = AcademicYear::where('is_active', true)->first();

            // try to infer grade_level from manual name (expects e.g. "10-1"), fallback to 10
            $gradeLevel = 10;
            if (preg_match('/\\b(10|11|12)\\b/', $request->class_manual, $m)) {
                $gradeLevel = (int) $m[1];
            } elseif (preg_match('/^(10|11|12)/', $request->class_manual, $m2)) {
                $gradeLevel = (int) $m2[1];
            }

            $classId = ClassRoom::firstOrCreate([
                'name' => $request->class_manual,
                'major_id' => $request->major_id,
                'grade_level' => $gradeLevel,
                'academic_year_id' => $activeYear->id ?? null,
            ])->id;
        }

        // Buat user baru dengan data akademik
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'status' => 'aktif',
            'major_id' => $request->major_id,
            'class_id' => $classId,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        // Create siswa profile untuk backward compatibility
        try {
            Siswa::create([
                'user_id' => $user->id,
                'nis' => $nis,
                'nama' => $request->nama,
                'major_id' => $request->major_id,
                'class_id' => $classId,
                'academic_year_id' => $activeYear->id ?? null,
                'kelas' => optional(ClassRoom::find($classId))->name ?? $request->class_manual ?? 'Unknown',
                'jenis_kelamin' => $request->jenis_kelamin ?? 'L',
                'alamat' => $request->alamat ?? '',
            ]);
        } catch (\Exception $e) {
            // If siswa creation fails, delete the user
            $user->delete();
            throw $e;
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('siswa.dashboard'));
    }

}

