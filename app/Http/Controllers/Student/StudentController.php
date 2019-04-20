<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
        $this->middleware('active');
    }

    public function dashboard()
    {
        return view('student.dashboard');
    }
}
