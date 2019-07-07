<!-- Menu Mobile -->
<div class="wrap-side-menu" >
    <nav class="side-menu">
        <ul class="main-menu">

            <li class="item-topbar-mobile p-l-10">
                <div class="topbar-social-mobile">
                    <a href="#" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
                    <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                </div>
            </li>

            <li class="item-menu-mobile">
                <a href="#">Home</a>
            </li>

            <li class="item-menu-mobile">
                <a href="#">Courses</a>
            </li>

            <li class="item-menu-mobile">
                <a href="#">Articles</a>
            </li>

            <li class="item-menu-mobile">
                <a href="#">Discussion</a>
            </li>

            <li class="item-menu-mobile">
                <a href="#">About</a>
            </li>

            <li class="item-menu-mobile">
                <a href="#">Contact</a>
            </li>

            @auth

                @if(Auth::user()->isAdmin())
                    <li class="item-menu-mobile">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @elseif(Auth::user()->isTeacher())
                    <li class="item-menu-mobile">
                        <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="item-menu-mobile">
                        <a href="{{ route('student.dashboard') }}">Dashboard</a>
                    </li>
                @endif

                <li class="item-menu-mobile">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        Logout
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @else

                <li class="item-menu-mobile">
                    <a href="{{ route('login') }}">Login</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{ route('register') }}">Register</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{ route('landing.registerTeacher') }}">Become a teacher</a>
                </li>

            @endauth
        </ul>
    </nav>
</div>
</header>