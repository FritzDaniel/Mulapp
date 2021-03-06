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
    <li @if(strpos(Route::currentRouteName(),'teacher.notify.') !== false) class="active" @endif>
        <a href="{{ route('teacher.notify.viewAll') }}"><i class="fa fa-envelope"></i> <span>Notification</span>
            @if(!empty($notify->where('read_at','=',null)->count()))
                <span class="pull-right-container">
                    <small class="label pull-right bg-green">new</small>
                </span>
            @endif
        </a>
    </li>
    <li>
        <a href="#"><i class="fa fa-product-hunt"></i> <span>Points</span></a>
    </li>
    <li>
        <a href="#"><i class="fa fa-bar-chart"></i> <span>Statistic</span></a>
    </li>
    <li class="header">Teaching</li>
    <li @if(strpos(Route::currentRouteName(),'teacher.article') !== false) class="active" @endif>
        <a href="{{ route('teacher.article') }}"><i class="fa fa-files-o"></i> <span>Articles</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'teacher.courses') !== false) class="active" @endif>
        <a href="{{ route('teacher.courses') }}"><i class="fa fa-play-circle"></i> <span>Courses</span></a>
    </li>
    <li class="header">Support</li>
    <li>
        <a href="#"><i class="fa fa-bullhorn"></i> <span>Report a bug</span></a>
    </li>
    <li>
        <a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a>
    </li>
</ul>                                     