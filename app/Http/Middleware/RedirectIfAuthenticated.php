<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->tipo === 'superusuario') {
                    return redirect('/admin');
                } elseif (Auth::user()->tipo === 'profesor') {
                    return redirect('/dashboard-profesor');
                } elseif (Auth::user()->tipo === 'alumno') {
                    return redirect('/dashboard-alumno');
                }
            }            
        }

        return $next($request);
    }
}
