<h1>
    @yield('headerTitle')
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Route</a></li>
    <li class="active">{{ Route::currentRouteName() }}</li>
</ol>