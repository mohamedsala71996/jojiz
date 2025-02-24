<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class AppModeGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            $ignore_routes = ['logout','admin-login','login','register'];

            $request_path = $request->path();
            $request_path = explode('?', $request_path);
            $request_path = array_shift($request_path);
            $request_path = explode("/", $request_path);
            $request_path = array_pop($request_path);

            if (!in_array($request_path, $ignore_routes)) {

                if (env("APP_MODE") != 'live') {
                    if ($request->expectsJson()) {
                        return ApiResponse::onlyError('Can\'t change anything for demo application.');
                    }
                    Toastr::warning('Can\'t change anything for demo application');
                    throw ValidationException::withMessages([
                        'unknown'   => 'Can\'t change anything for demo application.',
                    ]);
                }
            }
        }
        return $next($request);
    }
}
