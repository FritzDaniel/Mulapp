<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.partials.head')

    @include('admin.layouts.partials.css')
</head>
<body class="hold-transition skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
    <header class="main-header">
        @include('admin.layouts.partials.header')
    </header>
    <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
            @include('admin.layouts.partials.sidebar')
        </section>
    </aside>
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            @include('admin.layouts.partials.breadcrumb')
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        @include('admin.layouts.partials.footer')
    </footer>
</div>

@include('admin.layouts.partials.script')

<div class="jvectormap-label">

</div>
</body>
</html>