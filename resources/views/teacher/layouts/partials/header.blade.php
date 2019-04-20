<a href="{{ url('/') }}" class="logo">
    <span class="logo-mini"><b>M</b></span>
    <span class="logo-lg"><b>Mul</b>-App</span>
</a>
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="padding: 18px 15px;">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">0</span>
                </a>
                @include('teacher.layouts.partials.notification')
            </li>

            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->avatar == "default.jpg")
                        <img class="user-image" src="{{ asset('assets/img/default.jpg') }}" alt="user-image">
                    @else
                        <img class="user-image" src="{{ asset('assets/uploads/avatar/'.Auth::user()->avatar) }}" alt="user-image">
                    @endif
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        @if(Auth::user()->avatar == "default.jpg")
                            <img src="{{ asset('assets/img/default.jpg') }}" class="img-circle" alt="User Image">
                        @else
                            <img src="{{ asset('assets/uploads/avatar/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                        @endif

                        <p>
                            {{ Auth::user()->name }} - Teacher
                            <small>Teacher since {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y') }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ route('teacher.profile') }}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>