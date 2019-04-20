<!DOCTYPE html>
<html>
<head>
    @include('teacher.layouts.partials.head')

    @include('teacher.layouts.partials.css')
</head>
<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
    <header class="main-header">
        @include('teacher.layouts.partials.header')
    </header>
    <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
            @include('teacher.layouts.partials.sidebar')
        </section>
    </aside>
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            @include('teacher.layouts.partials.breadcrumb')
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        @include('teacher.layouts.partials.footer')
    </footer>
</div>

@include('teacher.layouts.partials.script')

<div class="jvectormap-label">

</div>
</body>
</html>