<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!session('user') || session('user')->role !== $role) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
