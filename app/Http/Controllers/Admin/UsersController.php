<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('active');
    }

    public function index()
    {
        $data = User::all();
        return view('admin.menu.users.index',compact('data'));
    }

    public function addUser()
    {
        return view('admin.menu.users.add');
    }

    public function addAccount(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255'],
            'password' => ['required', 'string', 'min:6'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','numeric'],
            'dob' => ['required','date'],
            'roles' => ['required'],
        ]);
        $store = new User();
        $store->name = $request['name'];
        $store->username = $request['username'];
        $store->email = $request['email'];
        $store->password = Hash::make($request['password']);
        $store->gender = $request['gender'];
        $store->dob = $request['dob'];
        $store->phone = $request['phone'];
        $store->roles = $request['roles'];
        $store->avatar = "default.jpg";
        $store->status = "active";
        $store->save();

        return redirect('admin/users')->with('status','Account successfully added!');
    }

    public function showDetail($id)
    {
        $data = User::where('id','=',$id)->first();
        return view('admin.menu.users.show',compact('data'));
    }

    public function editUser($id)
    {
        $data = User::where('id','=',$id)->first();
        return view('admin.menu.users.edit',compact('data'));
    }

    public function updateData(Request $request,$id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric'],

        ]);
        $update = User::where('id','=',$id)->first();
        $update->name = $request['name'];
        $update->username = $request['username'];
        $update->email = $request['email'];
        $update->gender = $request['gender'];
        $update->dob = $request['dob'];
        $update->phone = $request['phone'];
        $update->update();

        return redirect()->back()->with('status','Data successfully updated!');
    }

    public function updatePassword(Request $request,$id)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $update = User::where('id','=',$id)->first();
        $update->password = Hash::make($request['password']);
        $update->update();

        return redirect()->back()->with('status','Data successfully updated!');
    }

    public function updateDisplayPicture(Request $request,$id)
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

        $update = User::where('id','=',$id)->first();
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

    public function changeStatusDeactivate($id)
    {
        $status = User::where('id','=',$id)->first();
        $status->status = "deactivate";
        $status->update();

        return redirect()->back()->with('status','Status successfully updated!');
    }

    public function changeStatusActive($id)
    {
        $status = User::where('id','=',$id)->first();
        $status->status = "active";
        $status->update();

        return redirect()->back()->with('status','Status successfully updated!');
    }
}
