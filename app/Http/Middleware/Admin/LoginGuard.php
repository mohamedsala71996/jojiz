<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check() == true) {
            if($request->routeIs('admin.*')) {
                return redirect(route('admin.dashboard'));
            }elseif($request->routeIs('user.*')) {
                return redirect(route('user.dashboard'));
            }
        }
        return $next($request);
    }
}



