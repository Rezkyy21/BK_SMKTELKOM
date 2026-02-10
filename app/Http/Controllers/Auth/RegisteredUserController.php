<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
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
        return view('auth.register');
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
        'kelas' => ['required', 'string'],
    ]);

    $user = User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'siswa', // otomatis siswa
    ]);

    // Create siswa profile
    try {
        Siswa::create([
            'user_id' => $user->id,
            'nis' => $nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
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

