<?php

namespace App\Http\Controllers\Landing;

use App\Models\Blog\Blogs;
use App\Models\Student\Discussion;
use App\Teacher\CourseData;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LandingController extends Controller
{

    public function index()
    {
        $data_courses = CourseData::all();
        $data_articles = Blogs::all();
        $data_discussions = Discussion::all();
        return view('landing.home',compact('data_articles','data_courses','data_discussions'));
    }

    public function registerTeacher()
    {
        return view('auth.registerTeacher');
    }

    public function storeTeacher(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255'],
            'password' => ['required', 'string', 'min:6','confirmed'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $store = new User();
        $store->name = $request['name'];
        $store->username = $request['username'];
        $store->email = $request['email'];
        $store->password = Hash::make($request['password']);
        $store->avatar = "default.jpg";
        $store->status = "active";
        $store->roles = "teacher";
        $store->save();

        return redirect('login')->with('status','Success Register! Now login to proceed!');
    }

}
