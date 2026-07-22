<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Menggunakan ...$roles agar bisa menerima banyak role sekaligus (contoh: role:super_admin,staff)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek apakah role user saat ini ada di dalam daftar $roles yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya izin, kembalikan ke halaman utama dengan pesan error
        return redirect('/')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman tersebut.');
    }
}