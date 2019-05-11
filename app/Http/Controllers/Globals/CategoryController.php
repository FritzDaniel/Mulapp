<?php

namespace App\Http\Controllers\Globals;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $nav = Category::all();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = Category::where('category', 'LIKE', "%$keyword%")
                ->orderBy('created_at','ASC')
                ->get();
        } else {
            $data = Category::orderBy('id','ASC')->paginate(10);
        }
        return view('admin.menu.category.index',compact('data','keyword','nav'));
    }

    public function add()
    {
        return view('admin.menu.category.add');
    }

    public function show($id)
    {
        $data = Category::find($id);
        return view('admin.menu.category.show',compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        $store = new Category();
        $store->category = $request['category'];
        $store->save();

        return redirect()->route('admin.category')->with('status','New category has been added!');
    }

    public function edit($id)
    {
        $data = Category::where('id',$id)->first();
        return view('admin.menu.category.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        $update = Category::where('id',$id)->first();
        $update->category = $request['category'];
        $update->update();

        return redirect()->route('admin.category')->with('status','Category has been updated!');
    }

    public function delete($id)
    {
        $data = Category::where('id',$id)->first();
        $data->delete();

        return redirect()->route('admin.category')->with('status','Category has been deleted!');
    }
}
