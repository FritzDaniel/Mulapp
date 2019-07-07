<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseVideoOwnerMiddleware
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

        $data = DB::table('course_videos')
            ->join('courses', 'course_videos.course_id', '=', 'courses.id')
            ->join('users', 'courses.user_id', '=', 'users.id')
            ->select('courses.user_id','course_videos.course_id')
            ->where('course_videos.course_id','=',$id)
            ->first();

        if ($data == null)
        {
            return $next($request);
        }else {
            if ($data->user_id !== Auth::user()->id)
            {
                return redirect()->to('/');
            }
            else
            {
                return $next($request);
            }
        }
    }
}
