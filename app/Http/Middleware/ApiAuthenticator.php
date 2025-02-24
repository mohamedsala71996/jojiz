<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\UnauthorizedException;

class ApiAuthenticator extends Authenticate
{
    protected function authenticate($request, array $guards)
    {
       
        // if ($this->auth->guard('api')->check()) {
        //     return $this->auth->shouldUse('api');
        // }
        // throw new UnauthorizedException('sorry');

        //for testing
        if ($this->auth->guard('api')->check()) {
            return $this->auth->shouldUse('api');
        } else {
            return $this->auth->shouldUse('api');
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        } catch (UnauthorizedException $e) {

            return response()->json([
                'message'=>'Unauthorized user'
            ],401);
        }
        return $next($request);
    }
}
