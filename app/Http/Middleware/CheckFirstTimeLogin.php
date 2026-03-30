<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFirstTimeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only check for siswa
        if (auth()->check() && auth()->user()->role === 'siswa') {
            $siswa = auth()->user()->siswa;

            // Allow career-plan routes for imported siswa even before password change,
            // so mereka tetap bisa submit rencana karir sekaligus sinkronisasi dengan guru BK.
            $isCareerPlanRoute = $request->routeIs('career-plan.*');

            // If siswa hasn't completed profile and is not already on profile edit page
            if ($siswa && !$siswa->is_password_changed && !$isCareerPlanRoute &&
                !$request->routeIs('siswa.profile.edit') && 
                !$request->routeIs('siswa.profile.update')) {
                
                return redirect()->route('siswa.profile.edit')
                    ->with('warning', 'Anda harus melengkapi profil dan mengganti password terlebih dahulu.');
            }
        }

        return $next($request);
    }
}
