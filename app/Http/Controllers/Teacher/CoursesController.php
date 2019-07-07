<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Category;
use App\Models\Tags;
use App\Models\Teacher\Courses;
use App\Models\Teacher\CourseVideos;
use App\Teacher\CourseData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index()
    {
        $nav = Courses::where('user_id','=',Auth::user()->id)
            ->get();
        $data = Courses::where('user_id','=',Auth::user()->id)
            ->orderBy('title','DESC')
            ->paginate(10);
        return view('teacher.menu.courses.index',compact('data','nav'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('teacher.menu.courses.add',compact('categories'));
    }

    public function storeCourse(Request $request)
    {
        $this->validate($request,[
            'title' => ['required','min:6','max:100'],
        ]);

        $store = new Courses();
        $store->user_id = Auth::user()->id;
        $store->title = $request['title'];
        $store->slug = $store->title;
        $store->category_id = $request['category_id'];
        $store->status = 0;
        $store->save();

        $data = [
            'course_id' => $store->id,
            'objective' => $request['objective'],
            'requirement' => $request['requirement'],
            'target' => $request['target'],
        ];
        CourseData::create($data);

        return redirect()->route('teacher.courses')->with('status','Course has been successfully created!');
    }

    public function detailCourse($id)
    {
        $tags = Tags::all();
        $category = Category::all();

        $data = Courses::where('id','=',$id)
            ->first();
        $dataCourse = CourseData::where('course_id','=',$id)->first();

        return view('teacher.menu.courses.editCourseData',compact('data','dataCourse','category','tags'));
    }

    public function editCourseData(Request $request, $id)
    {
        $this->validate($request,[
            'title' => ['required','min:6','max:100'],
            'category' => 'required',
            'objective' => 'required',
            'requirement' => 'required',
            'target' => 'required',
            'priceType' => 'required',
            'description' => 'required'
        ]);

        $data = Courses::where('id','=',$id)->first();
        $data->title = $request['title'];
        $data->category_id = $request['category'];
        $data->slug = $data->title;
        $data->update();

        if ($request['priceType'] == 1)
        {
            $this->validate($request,[
                'price' => 'required',
            ]);

            $courseData = [
                'objective' => $request['objective'],
                'requirement' => $request['requirement'],
                'target' => $request['target'],
                'priceType' => $request['priceType'],
                'price' => $request['price'],
                'description' => $request['description'],
            ];

            $update = CourseData::where('course_id','=',$id)->first();
            $update->update($courseData);
        }else{

            $courseData = [
                'objective' => $request['objective'],
                'requirement' => $request['requirement'],
                'target' => $request['target'],
                'priceType' => $request['priceType'],
                'price' => null,
                'description' => $request['description'],
            ];

            $update = CourseData::where('course_id','=',$id)->first();
            $update->update($courseData);
        }

        if ($request['priceType'] == 1)
        {
            $this->validate($request,[
                'price' => 'required',
            ]);

            $update = CourseData::where('course_id','=',$id)->first();
            $update->update($courseData);
        }else{
            $update = CourseData::where('course_id','=',$id)->first();
            $update->price = 0;

            $update->update($courseData);
        }

        return redirect()->back()->with('status','Data course is successfully updated!');
    }

    public function editCourseThumbnail(Request $request, $id)
    {
        $this->validate($request, [
            'thumbnail' => ['Image', 'mimes:jpeg,jpg,png'],
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $name = Auth::user()->name .'_videoCourse'. '_' . Carbon::now()->timestamp . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $store_path = 'thumbnail/';
                $path = $request->file('thumbnail')->storeAs($store_path, $name);
            }
        }

        $update = CourseData::where('course_id','=',$id)->first();
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

    public function editVideoCourse($id)
    {
        $nav = CourseVideos::where('course_id','=',$id)->get();

        $data = Courses::where('id','=',$id)
            ->first();
        $dataVideo = CourseVideos::where('course_id','=',$id)->paginate(10);

        return view('teacher.menu.courses.videoCourse',compact('nav','data','dataVideo'));
    }

    public function addVideoCourse($id)
    {
        $data = Courses::where('id','=',$id)
            ->first();

        return view('teacher.menu.courses.addVideoCourse',compact('data'));
    }

    public function storeVideoCourse(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required','min:6','max:100'],
            'description' => ['required'],
            'video' => ['required','File', 'mimes:mp4,ogv,webm'],
        ]);

        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $name = Auth::user()->name .'_' .$request['title']. '_' . Carbon::now()->timestamp . '.' . $request->file('video')->getClientOriginalExtension();
                $store_path = 'videoCourse/';
                $path = $request->file('video')->storeAs($store_path, $name);
            }
        }

        $store = new CourseVideos();
        $store->course_id = $id;
        $store->title = $request['title'];
        $store->slug = $store->title;
        $store->description = $request['description'];
        $store->video = isset($name) ? $name : null;
        $store->save();

        return redirect('teacher/courses/videoCourse/'.$id)->with('status','Video course is added!');
    }

    public function videoDetail($id,$slug)
    {
        $course = $id;
        $data = CourseVideos::where('course_id','=',$course)
            ->where('slug','=',$slug)->first();

        return view('teacher.menu.courses.videoDetail',compact('data','course'));
    }
}
