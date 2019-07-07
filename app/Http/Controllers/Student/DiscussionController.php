<?php

namespace App\Http\Controllers\Student;

use App\Models\Student\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $data = Discussion::where('user_id','=',Auth::user()->id)->get();
        return view('student.menu.discussion.index',compact('data'));
    }

    public function add()
    {
        return view('student.menu.discussion.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'body' => ['required'],
        ]);

        $store = new Discussion();
        $store->title = $request['title'];
        $store->body = $request['body'];
        $store->user_id = Auth::user()->id;
        $store->save();

        return redirect()->route('student.discussion')->with('status','Discussion Created!');
    }
}
