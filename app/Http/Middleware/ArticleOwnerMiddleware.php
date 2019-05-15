<?php

namespace App\Http\Middleware;

use App\Models\Blog\Blogs;
use Closure;
use Illuminate\Support\Facades\Auth;

class ArticleOwnerMiddleware
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

        $data = Blogs::where('id','=',$id)->first();

        if($data->user_id == Auth::user()->id)
        {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
