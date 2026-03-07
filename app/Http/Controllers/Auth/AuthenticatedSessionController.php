<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LoginSiswaRequest;
use Filament\Facades\Filament;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Determine if this is siswa (NIS) or guru (email) login
        $input = $request->input('email');
        $isSiswaLogin = !empty($input) && !str_contains($input, '@');
        
        if ($isSiswaLogin) {
            // Siswa login dengan NIS
            $this->siswaLogin($request);
        } else {
            // Guru/Admin login dengan email
            $loginRequest = new LoginRequest();
            $loginRequest->merge($request->all());
            $loginRequest->validate($loginRequest->rules());
            $loginRequest->authenticate();
        }

        $request->session()->regenerate();
        $user = auth()->user();

        // For siswa: check if they need to complete profile
        if ($user->role === 'siswa') {
            $siswa = $user->siswa;
            if ($siswa && $siswa->needsProfileCompletion()) {
                return redirect()->route('siswa.profile.edit');
            }
            return redirect()->route('siswa.dashboard');
        }

        // For guru/admin
        if ($user->role === 'admin') {
            return redirect(Filament::getPanel('admin')->getUrl());
        }

        if ($user->role === 'guru_bk' || $user->role === 'guru') {
            return redirect(route('guru.dashboard'));
        }

        return redirect(route('siswa.dashboard'));
    }

    /**
     * Handle siswa login with NIS
     */
    private function siswaLogin(Request $request): void
    {
        $nis = $request->input('email');
        $password = $request->input('password');

        // Find siswa by NIS
        $siswa = \App\Models\Siswa::where('nis', $nis)->first();
        
        if (!$siswa || !$siswa->user) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $user = $siswa->user;

        // Verify password
        if (!password_verify($password, $user->password)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Check if account is active
        if ($user->status_akun !== 'aktif') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akun Anda tidak aktif. Hubungi guru BK.',
            ]);
        }

        // Login
        Auth::login($user, $request->boolean('remember'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
