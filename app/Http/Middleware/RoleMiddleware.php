<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja la autorización basada en roles.
     */
    public function handle($request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y tiene el rol correcto
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
