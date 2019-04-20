<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::where('username','=','admin')->first();
        return view('admin.menu.profile.index',compact('data'));
    }

    public function edit()
    {
        $data = User::where('username','=','admin')->first();
        return view('admin.menu.profile.edit',compact('data'));
    }

    public function updateData(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric'],

        ]);
        $update = User::where('id','=',Auth::user()->id)->first();
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
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $update = User::where('id','=',Auth::user()->id)->first();
        $update->password = Hash::make($request['password']);
        $update->update();

        return redirect()->back()->with('status','Data successfully updated!');
    }

    public function updateDisplayPicture(Request $request)
    {
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

        $update = User::where('id','=',Auth::user()->id)->first();
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
