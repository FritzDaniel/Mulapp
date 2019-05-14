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
                        <a href="{{ route('student.notify.read',$notification->notify_id) }}">
                            @if($notification->read_at == null)
                                <i class="fa fa-sticky-note"></i> <b>{{ isset($notification) ? $notification->notify->title : '' }}</b> <small class="label pull-right bg-green">new</small>
                            @else
                                <i class="fa fa-sticky-note"></i> {{ isset($notification) ? $notification->notify->title : '' }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="#">View all</a></li>
    @endif
</ul>