<?php

namespace App\Http\Controllers\Student;

use App\Listeners\UpdateReadAt;
use App\Models\NotifyList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function index()
    {

    }

    public function detail($id)
    {
        $data = NotifyList::find($id);

        event(new UpdateReadAt($data));
        return view('student.menu.notify.detail',compact('data'));
    }
}
