<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNotFirstTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->first_time) {
            return response()->redirectToRoute('first-time.index');
        }

        return $next($request);
    }
}
