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
    <li class="header">Dashboard</li>
    <li @if(Route::currentRouteName() == 'admin.dashboard') class="active" @endif >
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="header">Community</li>
    <li @if(strpos(Route::currentRouteName(),'admin.blogs.index') !== false) class="active" @endif>
        <a href="{{ route('admin.blogs.index') }}"><i class="fa fa-files-o"></i> <span>Blogs</span></a>
    </li>
    <li class="header">Forms control</li>
    <li @if(strpos(Route::currentRouteName(),'admin.category') !== false) class="active" @endif>
        <a href="{{ route('admin.category') }}"><i class="fa fa-tag"></i> <span>Category</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'admin.tags') !== false) class="active" @endif>
        <a href="{{ route('admin.tags') }}"><i class="fa fa-tags"></i> <span>Tags</span></a>
    </li>
    <li class="header">Web control</li>
    <li @if(strpos(Route::currentRouteName(),'admin.users') !== false) class="active" @endif>
        <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>Users</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'admin.point') !== false) class="active" @endif>
        <a href="{{ route('admin.point') }}"><i class="fa fa-money"></i> <span>Manage Points</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'admin.notify') !== false) class="active" @endif>
        <a href="{{ route('admin.notify') }}"><i class="fa fa-commenting"></i> <span>Notify user</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'admin.statistic') !== false) class="active" @endif>
        <a href="{{ route('admin.statistic') }}"><i class="fa fa-line-chart"></i> <span>Statistic</span></a>
    </li>
    <li @if(strpos(Route::currentRouteName(),'admin.support') !== false) class="active" @endif>
        <a href="{{ route('admin.support') }}"><i class="fa fa-support"></i> <span>Support center</span></a>
    </li>
</ul>