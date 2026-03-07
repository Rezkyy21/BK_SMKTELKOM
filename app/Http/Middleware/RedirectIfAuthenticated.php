<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check()) {
            $user = auth()->user();

            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            if ($user->role === 'guru_bk' || $user->role === 'guru') {
                return redirect('/guru/dashboard');
            }

            return redirect('/siswa/dashboard');
        }

        return $next($request);
    }
}
