<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * Middleware ini memastikan user sudah memilih role
     * sebelum bisa akses halaman apapun selain role-selection
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login, biarkan middleware auth yang handle
        if (!auth()->check()) {
            return $next($request);
        }

        // Jika user belum punya role, redirect ke role selection
        if (auth()->user()->role === null) {
            return redirect()->route('role.selection')
                ->with('warning', 'Silakan pilih peran Anda terlebih dahulu.');
        }

        // Jika sudah punya role, lanjutkan request
        return $next($request);
    }
}