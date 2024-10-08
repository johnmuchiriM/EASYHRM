<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AccessMiddleware
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
        if (Auth::user()->role_id == 1) {
            return $next($request);
        } else {
            return $request->ajax ? response('Unauthorized.', 401) : redirect('/login');
        }
    }
}
