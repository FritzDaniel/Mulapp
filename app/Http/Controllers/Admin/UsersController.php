<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('admin.menu.users.index',compact('data'));
    }

    public function showDetail($username)
    {
        $data = User::where('username','=',$username)->first();
        return view('admin.menu.users.show',compact('data'));
    }
}
