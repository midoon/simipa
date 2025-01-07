<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->session()->get('teacher')['role'] == 'teacher' || collect(session('teacher')['role'])->contains('bendahara')) {
            return $next($request);
        }

         return redirect('/teacher/login')->with('error', 'Akses ditolak. Silakan login sebagai guru.');
    }
}
