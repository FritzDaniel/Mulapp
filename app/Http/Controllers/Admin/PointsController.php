<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)){
            $dataUser = User::where('name', 'LIKE', "%$keyword%")
                ->orderBy('id','ASC')
                ->get();
        } else {
            $dataUser = User::orderBy('id','ASC')->paginate(10);
        }
        return view('admin.menu.points.index',compact('dataUser','keyword'));
    }

    public function topup($id)
    {
        $user = User::find($id);
        return view('admin.menu.points.topup',compact('user'));
    }

    public function updateTopup(Request $request,$id)
    {
        $this->validate($request,[
            'point' => ['required','numeric'],
        ]);

        $user = User::find($id);
        $user->point = $user->point + $request['point'];
        $user->update();

        return redirect()->route('admin.points')->with('status','Points has been updated!');
    }

    public function withdraw($id)
    {
        $user = User::find($id);
        return view('admin.menu.points.withdraw',compact('user'));
    }

    public function updateWithdraw(Request $request,$id)
    {
        $this->validate($request,[
            'point' => ['required','numeric'],
        ]);

        $user = User::find($id);
        if ($user->point == 0)
        {
            return redirect()->route('admin.points')->with('error','Points '.$user->name.' is 0!');

        }elseif($request['point'] > $user->point){

            return redirect()->route('admin.points')->with('error','insufficient '.$user->name.' point!');

        }else{

            $user->point = $user->point - $request['point'];
            $user->update();

            return redirect()->route('admin.points')->with('status','Points has been updated!');
        }
    }
}
