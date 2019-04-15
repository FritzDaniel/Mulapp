<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->roles != 'student')
        {
            return new Response(view('error.401')->with('roles', 'student'));
        }
        return $next($request);
    }
}
