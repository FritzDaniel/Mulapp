<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog\Blogs;
use App\Models\Blog\BlogsTags;
use App\Models\Blog\Category;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('active');
    }

    // Blogs

    public function index(Request $request)
    {
        $nav = Blogs::all();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('blogs')
                ->join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.id','users.name','blogs.title','blogs.created_at')
                ->where('users.name', 'LIKE', "%$keyword%")
                ->orWhere('blogs.title', 'LIKE', "%$keyword%")
                ->get();
        } else {
            $data = Blogs::orderBy('created_at','DESC')->paginate(10);
        }
        return view('admin.menu.blogs.index',compact('data','keyword','nav'));
    }

    public function detailBlogs($id)
    {
        $data = Blogs::find($id);
        $dataTags = BlogsTags::where('blogs_id','=',$id)->get();
        return view('admin.menu.blogs.detail',compact('data','dataTags'));
    }

    public function editBlogs($id)
    {
        $tags = Tags::orderBy('created_at','DESC')->get();
        $cat = Category::all();
        $data = Blogs::find($id);
        $tagsData = BlogsTags::where('blogs_id','=',$data->id)->get();

        return view('admin.menu.blogs.edit',compact('data','cat','tags','tagsData'));
    }

    public function add()
    {
        $tags = Tags::orderBy('created_at','DESC')->get();
        $cat = Category::all();
        return view('admin.menu.blogs.add',compact('cat','tags'));
    }

    // Store Blogs

    public function storeBlogs(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'category' => ['required'],
            'tags' => ['required'],
            'body' => ['required'],
            'thumbnail' => ['Image', 'mimes:jpeg,jpg,png'],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $name = Auth::user()->name . '_' . Carbon::now()->timestamp . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $store_path = 'thumbnail/';
                $path = $request->file('thumbnail')->storeAs($store_path, $name);
            }
        }

        $store = new Blogs();
        $store->user_id = Auth::user()->id;
        $store->title = $request['title'];
        $store->slug = $store->title;
        $store->category_id = $request['category'];
        $store->body = $request['body'];
        $store->thumbnail = isset($name) ? $name : null;
        $store->allow_comment = $request['allow_comment'];
        $store->save();

        foreach ($request['tags'] as $tags)
        {
            $storeTags = [
                'blogs_id' => $store->id,
                'tags_id' => $tags,
            ];
            BlogsTags::create($storeTags);
        }

        return redirect()->route('admin.blogs.index')->with('status','Blogs has been successfully created!');
    }

    public function updateBlogsData(Request $request ,$id)
    {
        $this->validate($request, [
            'title' => ['required'],
            'category' => ['required'],
            'tags' => ['required'],
        ]);

        $update = Blogs::where('id','=',$id)->first();
        $update->user_id = Auth::user()->id;
        $update->title = $request['title'];
        $update->slug = $update->title;
        $update->category_id = $request['category'];
        $update->allow_comment = $request['allow_comment'];
        $update->update();

        if ($request['tags'])
        {
            $delete = BlogsTags::where('blogs_id','=',$id)->get();
            foreach ($delete as $del)
            {
                $deleteData = BlogsTags::find($del->id);
                $deleteData->delete();
            }
        }

        foreach ($request['tags'] as $tags)
        {
            $storeTags = [
                'blogs_id' => $update->id,
                'tags_id' => $tags,
            ];
            BlogsTags::create($storeTags);
        }

        return redirect()->back()->with('status','Blogs has been successfully updated!');
    }

    public function updateBlogsThumbnail(Request $request,$id)
    {
        $this->validate($request, [
            'thumbnail' => ['Image', 'mimes:jpeg,jpg,png'],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $name = Auth::user()->name . '_' . Carbon::now()->timestamp . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $store_path = 'thumbnail/';
                $path = $request->file('thumbnail')->storeAs($store_path, $name);
            }
        }

        $update = Blogs::where('id','=',$id)->first();
        if ($update->thumbnail !== null)
        {
            $images_path = public_path().'/assets/uploads/thumbnail/'.$update->thumbnail;
            unlink($images_path);

            $update->thumbnail = isset($name) ? $name : null;
            $update->update();
        }else{
            $update->thumbnail = isset($name) ? $name : null;
            $update->update();
        }

        return redirect()->back()->with('status','Thumbnail is successfully updated!');
    }

    public function updateBlogsBody(Request $request,$id)
    {
        $this->validate($request, [
            'body' => ['required'],
        ]);

        $update = Blogs::where('id','=',$id)->first();
        $update->body = $request['body'];
        $update->update();

        return redirect()->back()->with('status','Body is successfully updated!');
    }

    public function deleteBlogs($id)
    {
        $data = Blogs::find($id);
        if ($data->thumbnail !== null)
        {
            $images_path = public_path().'/assets/uploads/thumbnail/'.$update->thumbnail;
            unlink($images_path);
        }
        $dataTags = BlogsTags::where('blogs_id','=',$id)->get();
        foreach ($dataTags as $tags)
        {
            $deleteData = BlogsTags::find($tags->id);
            $deleteData->delete();
        }
        $data->delete();
    }

    // Blogs Category

    public function category_index(Request $request)
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
        return view('admin.menu.blogs.category.index',compact('data','keyword','nav'));
    }

    public function addCategory()
    {
        return view('admin.menu.blogs.category.add');
    }

    public function showCategory($id)
    {
        $data = Category::find($id);
        return view('admin.menu.blogs.category.show',compact('data'));
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        $store = new Category();
        $store->category = $request['category'];
        $store->save();

        return redirect()->route('admin.blogs.category.index')->with('status','New category has been added!');
    }

    public function editCategory($id)
    {
        $data = Category::where('id',$id)->first();
        return view('admin.menu.blogs.category.edit',compact('data'));
    }

    public function updateCategory(Request $request,$id)
    {
        $this->validate($request,[
            'category' => 'required',
        ]);

        $update = Category::where('id',$id)->first();
        $update->category = $request['category'];
        $update->update();

        return redirect()->route('admin.blogs.category.index')->with('status','Category has been updated!');
    }

    public function deleteCategory($id)
    {
        $data = Category::where('id',$id)->first();
        $data->delete();

        return redirect()->route('admin.blogs.category.index')->with('status','Category has been deleted!');
    }
}
