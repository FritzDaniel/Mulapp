<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Blog\Blogs;
use App\Models\Blog\BlogsTags;
use App\Models\Category;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $nav = Blogs::where('user_id','=',Auth::user()->id)->get();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('blogs')
                ->join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.user_id','blogs.id','users.name','blogs.title','blogs.created_at')
                ->where('users.name', 'LIKE', "%$keyword%")
                ->orWhere('blogs.title', 'LIKE', "%$keyword%")
                ->where('blogs.user_id','=',Auth::user()->id)
                ->get();
        } else {
            $data = Blogs::where('user_id','=',Auth::user()->id)
                ->orderBy('created_at','DESC')
                ->paginate(10);
        }
        return view('teacher.menu.articles.index',compact('data','keyword','nav'));
    }

    public function detailBlogs($id)
    {
        $data = Blogs::where('id','=',$id)
            ->first();
        $dataTags = BlogsTags::where('blogs_id','=',$id)->get();
        return view('teacher.menu.articles.detail',compact('data','dataTags'));
    }

    public function editBlogs($id)
    {
        $tags = Tags::orderBy('tags','ASC')->get();
        $cat = Category::all();
        $data = Blogs::find($id);
        $tagsData = BlogsTags::where('blogs_id','=',$data->id)->get();

        return view('teacher.menu.articles.edit',compact('data','cat','tags','tagsData'));
    }

    public function add()
    {
        $tags = Tags::orderBy('tags','ASC')->get();
        $cat = Category::all();
        return view('teacher.menu.articles.add',compact('cat','tags'));
    }

    // Store Blogs

    public function storeBlogs(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'category' => ['required'],
            'tag' => ['required'],
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

        foreach ($request['tag'] as $tags)
        {
            $storeTags = [
                'blogs_id' => $store->id,
                'tags_id' => $tags,
            ];
            BlogsTags::create($storeTags);
        }

        return redirect()->route('teacher.article')->with('status','Article has been successfully created!');
    }

    public function updateBlogsData(Request $request ,$id)
    {
        $this->validate($request, [
            'title' => ['required'],
            'category' => ['required'],
            'tag' => ['required'],
        ]);

        $update = Blogs::where('id','=',$id)->first();
        $update->user_id = Auth::user()->id;
        $update->title = $request['title'];
        $update->slug = $update->title;
        $update->category_id = $request['category'];
        $update->allow_comment = $request['allow_comment'];
        $update->update();

        if ($request['tag'])
        {
            $delete = BlogsTags::where('blogs_id','=',$id)->get();
            foreach ($delete as $del)
            {
                $deleteData = BlogsTags::find($del->id);
                $deleteData->delete();
            }
        }

        foreach ($request['tag'] as $tags)
        {
            $storeTags = [
                'blogs_id' => $update->id,
                'tags_id' => $tags,
            ];
            BlogsTags::create($storeTags);
        }

        return redirect()->back()->with('status','Article has been successfully updated!');
    }

    public function updateBlogsThumbnail(Request $request,$id)
    {
        $this->validate($request, [
            'thumbnail' => ['Image', 'mimes:jpeg,jpg,png'],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $name = Auth::user()->name . '_article_'. '_' . Carbon::now()->timestamp . '.' . $request->file('thumbnail')->getClientOriginalExtension();
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
            $images_path = public_path().'/assets/uploads/thumbnail/'.$data->thumbnail;
            unlink($images_path);
        }
        $dataTags = BlogsTags::where('blogs_id','=',$id)->get();
        foreach ($dataTags as $tags)
        {
            $deleteData = BlogTags::find($tags->id);
            $deleteData->delete();
        }
        $data->delete();

        return redirect()->back()->with('status','Article has been successfully deleted!');
    }
}
