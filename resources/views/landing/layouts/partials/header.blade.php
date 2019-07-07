
<!-- header fixed -->
<div class="wrap_header fixed-header2 trans-0-4">
    <!-- Logo -->
    <a href="{{ route('landing') }}" class="logo">
        <h4>Mul-App</h4>
    </a>

    <!-- Menu -->
    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li>
                    <a href="{{ route('landing') }}">Home</a>
                </li>

                <li>
                    <a href="#">Courses</a>
                </li>

                <li>
                    <a href="#">Article</a>
                </li>

                <li>
                    <a href="#">Discussion</a>
                </li>

                <li>
                    <a href="#">About</a>
                </li>

                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Cart Icon -->
    <div class="header-icons">

        @auth

            <span class="header-wrapicon1 dis-block">
                <i style="font-size: 20px" class="fa fa-product-hunt"></i> : {{ Auth::user()->point }}
            </span>

            <span class="linedivide1"></span>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="header-wrapicon1 dis-block">
                    Dashboard
                </a>
            @elseif(Auth::user()->isTeacher())
                <a href="{{ route('teacher.dashboard') }}" class="header-wrapicon1 dis-block">
                    Dashboard
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" class="header-wrapicon1 dis-block">
                    Dashboard
                </a>
            @endif

            <span class="linedivide1"></span>

            <a href="{{ route('logout') }}" class="header-wrapicon1 dis-block"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
            >
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        @else
            <a href="{{ route('login') }}" class="header-wrapicon1 dis-block">
                Login
            </a>

            <span class="linedivide1"></span>

            <a href="{{ route('register') }}" class="header-wrapicon1 dis-block">
                Register
            </a>

            <span class="linedivide1"></span>

            <a href="{{ route('landing.registerTeacher') }}" class="header-wrapicon1 dis-block">
                Become a teacher
            </a>
        @endauth

    </div>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <!-- Logo2 -->
            <a href="{{ route('landing') }}" class="logo2 text-center">
                <h4>Mul-App</h4> <small>Multimedia Learning Online</small>
            </a>

            <div class="topbar-child2">

                @auth

                    <span class="header-wrapicon1 dis-block">
                        <i style="font-size: 20px" class="fa fa-product-hunt"></i> : {{ Auth::user()->point }}
                    </span>

                    <span class="linedivide1"></span>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="header-wrapicon1 dis-block">
                            Dashboard
                        </a>
                    @elseif(Auth::user()->isTeacher())
                        <a href="{{ route('teacher.dashboard') }}" class="header-wrapicon1 dis-block">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="header-wrapicon1 dis-block">
                            Dashboard
                        </a>
                    @endif

                    <span class="linedivide1"></span>

                    <a href="{{ route('register') }}" class="header-wrapicon1 dis-block"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @else
                    <a href="{{ route('login') }}" class="header-wrapicon1 dis-block">
                        Login
                    </a>

                    <span class="linedivide1"></span>

                    <a href="{{ route('register') }}" class="header-wrapicon1 dis-block">
                        Register
                    </a>

                    <span class="linedivide1"></span>

                    <a href="{{ route('landing.registerTeacher') }}" class="header-wrapicon1 dis-block">
                        Become a teacher
                    </a>
                @endauth

            </div>
        </div>

        <div class="wrap_header">

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="{{ route('landing') }}">Home</a>
                        </li>

                        <li>
                            <a href="#">Courses</a>
                        </li>

                        <li>
                            <a href="#">Articles</a>
                        </li>

                        <li>
                            <a href="#">Discussion</a>
                        </li>

                        <li>
                            <a href="#">About</a>
                        </li>

                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{ route('landing') }}" class="logo-mobile">
            <h4>Mul-App</h4>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

