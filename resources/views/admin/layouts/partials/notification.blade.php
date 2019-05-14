<ul class="dropdown-menu">
    <li class="header">Notification</li>
    @if($notify->isEmpty())
        <li>
            <ul class="menu">
                <li>
                    <a href="#">
                        <i class="fa fa-times"></i> No Notification
                    </a>
                </li>
            </ul>
        </li>
    @else
        <li>
            <ul class="menu">
                @foreach($notify as $notification)
                    <li>
                        <a href="{{ route('admin.notify.read',['id' => $notification->notify_id ,'title' => $notification->notify->title]) }}">
                            @if($notification->read_at == null)
                                <i class="fa fa-envelope"></i> <b>{{ isset($notification) ? $notification->notify->title : '' }}</b> <small class="label pull-right bg-green">new</small>
                            @else
                                <i class="fa fa-envelope-open-o"></i> {{ isset($notification) ? $notification->notify->title : '' }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="{{ route('admin.notify.viewAll') }}">View all</a></li>
    @endif
</ul>