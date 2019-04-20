<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
        $this->middleware('active');
    }
    public function dashboard()
    {
        return view('teacher.dashboard');
    }
}
