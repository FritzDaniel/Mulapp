<?php

namespace App\Http\Controllers\Student;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
        $this->middleware('active');
    }

    public function index()
    {
        $user = Auth::user()->id;
        $data = User::where('id','=',$user)->first();
        return view('student.menu.profile.index',compact('data'));
    }

    public function edit()
    {
        $user = Auth::user()->id;
        $data = User::where('id','=',$user)->first();
        return view('student.menu.profile.edit',compact('data'));
    }

    public function updateData(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric'],

        ]);
        $update = User::where('id','=',$user)->first();
        $update->name = $request['name'];
        $update->username = $request['username'];
        $update->email = $request['email'];
        $update->gender = $request['gender'];
        $update->dob = $request['dob'];
        $update->phone = $request['phone'];
        $update->update();

        return redirect()->back()->with('status','Data successfully updated!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $update = User::where('id','=',$user)->first();
        $update->password = Hash::make($request['password']);
        $update->update();

        return redirect()->back()->with('status','Data successfully updated!');
    }

    public function updateDisplayPicture(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, [
            'avatar' => ['Image','mimes:jpeg,jpg,png'],
        ]);

        if ($request->hasFile('avatar')){
            if ($request->file('avatar')->isValid()){
                $name = Auth::user()->name.'_'.Carbon::now()->timestamp.'.'.$request->file('avatar')->getClientOriginalExtension();
                $store_path = 'avatar/';
                $path = $request->file('avatar')->storeAs($store_path, $name);
            }
        }

        $update = User::where('id','=',$user)->first();
        if ($update->avatar !== "default.jpg" || "")
        {
            $images_path = public_path().'/assets/uploads/avatar/'.$update->avatar;
            unlink($images_path);

            $update->avatar = isset($name) ? $name : null;
            $update->update();
        }else{
            $update->avatar = isset($name) ? $name : null;
            $update->update();
        }

        return redirect()->back()->with('status','Data successfully updated!');
    }
}
