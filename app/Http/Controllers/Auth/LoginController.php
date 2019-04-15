<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo;

    public function redirectTo()
    {
        if (Auth::user()->isAdmin())
        {
            $this->redirectTo = 'admin/dashboard';
            return $this->redirectTo;
        }
        else if(Auth::user()->isTeacher())
        {
            $this->redirectTo = 'teacher/dashboard';
            return $this->redirectTo;
        }
        else if(Auth::user()->isStudent())
        {
            $this->redirectTo = 'student/dashboard';
            return $this->redirectTo;
        }
    }

    protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }
}
