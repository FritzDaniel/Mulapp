<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $data = User::where('username','=','admin')->first();
        return view('admin.menu.profile.index',compact('data'));
    }
}
