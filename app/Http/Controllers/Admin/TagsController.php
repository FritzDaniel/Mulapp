<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tags;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $nav = Tags::all();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('tags')
                ->join('users', 'tags.user_id', '=', 'users.id')
                ->select('tags.id','users.name','tags.tags','tags.created_at')
                ->where('users.name', 'LIKE', "%$keyword%")
                ->orWhere('tags', 'LIKE', "%$keyword%")
                ->get();
        } else {
            $data = Tags::orderBy('created_at','ASC')->paginate(10);
        }

        return view('admin.menu.tags.index',compact('data','keyword','nav'));
    }

    public function storeTags(Request $request)
    {
        $messages = [
            'unique' => 'Tags is already exist!',
        ];

        $this->validate($request,[
            'tag' => 'required|unique:tags',
        ], $messages);

        $store = new Tags();
        $store->user_id = Auth::user()->id;
        $store->tags = strtolower($request['tag']);
        $store->save();

        return redirect()->back()->with('status','New tags has been added!');
    }

    public function deleteTags($id)
    {
        $data = Tags::find($id);
        $data->delete();

        return redirect()->back()->with('status','Tags has been deleted!');
    }
}
