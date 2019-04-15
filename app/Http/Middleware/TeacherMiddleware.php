<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class TeacherMiddleware
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
        if ($request->user() && $request->user()->roles != 'teacher')
        {
            return new Response(view('error.401')->with('roles', 'teacher'));
        }
        return $next($request);
    }
}
