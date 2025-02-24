<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {

        if (!$request->expectsJson()) {

            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            } else if ($request->routeIs("user.*")) {
                // Toastr::success(__('backend.Please login first'));
                return route('login');
            }
            return route('login');
        }
    }
}
