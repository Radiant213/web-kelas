<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan yang dicek hanya role 'student' (siswa)
        if (Auth::check() && Auth::user()->role === 'student') {

            // Muat data studentProfile
            $user = Auth::user()->load('studentProfile');
            $profile = $user->studentProfile;

            // Logika: 
            // 1. Kalau profile belum ada (baru pertama login dari seeder) ATAU
            // 2. Kolom is_completed masih false
            if (!$profile || !$profile->is_completed) {

                // JIKA DIA SUDAH BERADA DI HALAMAN SETUP PROFILE, BIARKAN SAJA
                if ($request->routeIs('profile.setup') || $request->routeIs('profile.store')) {
                    return $next($request);
                }

                // TENDANG PAKSA KE HALAMAN SETUP PROFILE
                return redirect()->route('profile.setup');
            }
        }   

        // Jika profil sudah lengkap atau rolenya bukan siswa, lanjutkan ke tujuan
        return $next($request);
    }
}