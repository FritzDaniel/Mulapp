<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notify;
use App\Models\NotifyList;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('active');
    }

    public function index()
    {
        $users = User::all();
        $dataNotify = Notify::orderBy('id','DESC')->paginate(10);
        return view('admin.menu.notify.index',compact('users','dataNotify'));
    }

    public function detail($id)
    {
        $data = Notify::find($id);
        $dataNotify = NotifyList::where('notify_id','=',$data->id)->get();
        return view('admin.menu.notify.detail',compact('data','dataNotify'));
    }

    public function sendAll(Request $request)
    {
        $this->validate($request,[
            'title' => ['required','string'],
            'body' => ['required']
        ]);

        $send = new Notify();
        $send->type = "All User";
        $send->title = $request['title'];
        $send->body = $request['body'];
        $send->save();

        $users = User::all();
        foreach ($users as $user)
        {
            $sendAll = [
                'notify_id' => $send->id,
                'user_id' => $user->id,
            ];
            NotifyList::create($sendAll);
        }

        return redirect()->back()->with('status','Notify to all users success!');
    }

    public function sendSingle(Request $request)
    {
        $this->validate($request,[
            'title' => ['required','string'],
            'body' => ['required'],
            'user_id' => ['required']
        ]);

        $send = new Notify();
        $send->type = "Single user";
        $send->title = $request['title'];
        $send->body = $request['body'];
        $send->save();

        $sendSingle = [
            'notify_id' => $send->id,
            'user_id' => $request['user_id'],
        ];
        NotifyList::create($sendSingle);

        return redirect()->back()->with('status','Notify to user success!');
    }

    public function sendMultiple(Request $request)
    {
        $this->validate($request,[
            'title' => ['required','string'],
            'body' => ['required'],
            'user_id' => ['required']
        ]);

        $send = new Notify();
        $send->type = "Multiple users";
        $send->title = $request['title'];
        $send->body = $request['body'];
        $send->save();

        foreach ($request['user_id'] as $users)
        {
            $sendMultiple = [
                'notify_id' => $send->id,
                'user_id' => $users,
            ];
            NotifyList::create($sendMultiple);
        }

        return redirect()->back()->with('status','Notify to users success!');
    }
}
