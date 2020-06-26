<?php

namespace App\Http\Middleware;

use Closure;

class SharedSecret
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validToken = false;

        if ($request->headers->get('x-shared-secret') === env('SECRET_TOKEN')) {
            $validToken = true;
        }

        if (!$validToken) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
