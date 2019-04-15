<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AdminMiddleware
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
        if ($request->user() && $request->user()->roles != 'admin')
        {
            return new Response(view('error.401')->with('roles', 'admin'));
        }
        return $next($request);
    }
}
