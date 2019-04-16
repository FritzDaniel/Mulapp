<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::where('username','=','admin')->first();
        return view('admin.menu.profile.index',compact('data'));
    }

    public function edit()
    {
        $data = User::where('username','=','admin')->first();
        return view('admin.menu.profile.edit',compact('data'));
    }
}
