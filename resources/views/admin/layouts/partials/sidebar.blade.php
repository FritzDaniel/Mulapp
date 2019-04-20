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
    <li class="header">NAVIGATION</li>
    <li @if(Route::currentRouteName() == 'admin.dashboard') class="active" @endif ><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
</ul>