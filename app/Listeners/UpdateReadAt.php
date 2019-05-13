<?php

namespace App\Listeners;

use App\Models\NotifyList;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class UpdateReadAt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NotifyList $notify)
    {
        $this->handle($notify);
    }

    public function handle($notify)
    {
        $notif = NotifyList::where('id','=',$notify->id)
            ->where('user_id','=',Auth::user()->id)
            ->first();
        $notif->read_at = Carbon::now();
        $notif->update();
    }
}
