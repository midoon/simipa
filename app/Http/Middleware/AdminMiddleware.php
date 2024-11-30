<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Cek apakah session user ada dan role adalah admin
        if (!session()->has('user') || session('user.role') !== 'admin') {
            // Redirect ke login jika tidak memenuhi syarat
            return redirect('/admin/login')->with('error', 'Akses ditolak. Silakan login sebagai admin.');
        }

        return $next($request);
    }
}
