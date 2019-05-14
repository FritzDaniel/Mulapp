<?php

namespace App\Http\Controllers\Teacher;

use App\Listeners\UpdateReadAt;
use App\Models\NotifyList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
        $this->middleware('active');
    }

    public function viewAll(Request $request)
    {
        $nav = NotifyList::where('user_id','=',Auth::user()->id)->get();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('notify_list')
                ->join('notifies', 'notify_list.notify_id', '=', 'notifies.id')
                ->select('notify_list.id','notifies.title','notify_list.read_at','notify_list.created_at','notify_list.user_id')
                ->where('notifies.title', 'LIKE', "%$keyword%")
                ->where('notify_list.user_id','=',Auth::user()->id)
                ->orderBy('created_at','DESC')
                ->get();
        } else {
            $data = NotifyList::where('user_id','=',Auth::user()->id)
                ->orderBy('created_at','DESC')
                ->paginate(10);
        }

        return view('teacher.menu.notify.viewAll',compact('data','keyword','nav'));
    }

    public function readableTable(Request $request)
    {
        $nav = NotifyList::where('user_id','=',Auth::user()->id)->get();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('notify_list')
                ->join('notifies', 'notify_list.notify_id', '=', 'notifies.id')
                ->select('notify_list.id','notifies.title','notify_list.read_at','notify_list.created_at','notify_list.user_id')
                ->where('notifies.title', 'LIKE', "%$keyword%")
                ->where('notify_list.user_id','=',Auth::user()->id)
                ->where('read_at','<>',null)
                ->orderBy('created_at','DESC')
                ->get();
        } else {
            $data = NotifyList::where('user_id','=',Auth::user()->id)
                ->where('read_at','<>',null)
                ->orderBy('created_at','DESC')
                ->paginate(10);
        }

        return view('teacher.menu.notify.viewAll_readable',compact('data','keyword','nav'));
    }

    public function unreadableTable(Request $request)
    {
        $nav = NotifyList::where('user_id','=',Auth::user()->id)->get();

        $keyword = $request->get('search');

        if (!empty($keyword)){
            $data = DB::table('notify_list')
                ->join('notifies', 'notify_list.notify_id', '=', 'notifies.id')
                ->select('notify_list.id','notifies.title','notify_list.read_at','notify_list.created_at','notify_list.user_id')
                ->where('notifies.title', 'LIKE', "%$keyword%")
                ->where('notify_list.user_id','=',Auth::user()->id)
                ->where('read_at','=',null)
                ->orderBy('created_at','DESC')
                ->get();
        } else {
            $data = NotifyList::where('user_id','=',Auth::user()->id)
                ->where('read_at','=',null)
                ->orderBy('created_at','DESC')
                ->paginate(10);
        }

        return view('teacher.menu.notify.viewAll_unreadable',compact('data','keyword','nav'));
    }

    public function read($id)
    {
        $data = NotifyList::find($id);

        event(new UpdateReadAt($data));
        return view('teacher.menu.notify.read',compact('data'));
    }
}
