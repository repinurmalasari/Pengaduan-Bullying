<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // JIKA ROLE BELUM DIPILIH
        // Jangan blokir, biarkan lanjut (khusus role-selection)
        if (auth()->user()->role === null) {
            return $next($request);
        }

        // JIKA ROLE SESUAI
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // JIKA ROLE TIDAK SESUAI
        return redirect()->route('dashboard')
            ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
