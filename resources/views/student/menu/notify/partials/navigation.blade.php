<ul class="nav nav-pills nav-stacked">
    <li>
        <a href="{{ route('student.notify.viewAll') }}"><i class="fa fa-inbox"></i> All notification
            <span class="label label-info pull-right">{{ $nav->count() }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('student.notify.unreadable') }}"><i class="fa fa-envelope-o"></i> Unread notification
            <span class="label label-primary pull-right">{{ $nav->where('read_at','=',null)->count() }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('student.notify.readable') }}"><i class="fa fa-envelope-open-o"></i> Read notification
            <span class="label label-warning pull-right">{{ $nav->where('read_at','<>',null)->count() }}</span>
        </a>
    </li>
</ul>