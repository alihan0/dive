<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            // Eğer kullanıcı giriş yapmışsa ve admin ise devam et
            return $next($request);
        }

        // Admin değilse giriş yapma sayfasına yönlendir
        return redirect('/admin/login');
    }

}
