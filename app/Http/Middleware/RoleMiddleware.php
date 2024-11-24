<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // Obtén el usuario autenticado
        $user = Auth::user();

        // Verifica el rol del usuario
        if ($user->tipo !== $role) {
            return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
