<div class="user-panel">
    <div class="pull-left image">
        @if(Auth::user()->avatar == "default.jpg")
            <img src="{{ asset('assets/img/default.jpg') }}" class="img-circle" alt="User Image">
        @else
            <img src="{{ asset('assets/uploads/avatar/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
        @endif
    </div>
    <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>

<ul class="sidebar-menu tree" data-widget="tree">
    <li class="header">Menu</li>
    <li @if(Route::currentRouteName() == 'teacher.dashboard') class="active" @endif>
        <a href="{{ route('teacher.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'teacher.notify.x') !== false) class="active" @endif>
        <a href="{{ route('teacher.notify.viewAll') }}"><i class="fa fa-envelope"></i> <span>Notification</span>
            @if(!empty($notify->where('read_at','=',null)->count()))
                <span class="pull-right-container">
                    <small class="label pull-right bg-green">new</small>
                </span>
            @endif
        </a>
    </li>
</ul>                                     