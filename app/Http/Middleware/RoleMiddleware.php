<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        //ADMIN BOLEH AKSES SEMUA ROUTE
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Role selain admin
        if (! in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses');
        }

        return $next($request);
    }
}
