<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseDataOwnerMiddleware
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
        $id = $request->route()->parameters();

        $data = DB::table('course_data')
            ->join('courses', 'course_data.course_id', '=', 'courses.id')
            ->join('users', 'courses.user_id', '=', 'users.id')
            ->select('courses.user_id','course_data.course_id')
            ->where('course_data.course_id','=',$id)
            ->where('courses.user_id','=',Auth::user()->id)
            ->first();

        if($data == null)
        {
            return redirect()->to('/');
        }
        else
        {
            return $next($request);
        }
    }
}
