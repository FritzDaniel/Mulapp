<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function form()
    {
        return view('template.form');
    }

    public function card()
    {
        return view('template.card');
    }
}
