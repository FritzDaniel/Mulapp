<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('landing.layouts.partials.head')

<body class="animsition">

@include('landing.layouts.partials.header')

@include('landing.layouts.partials.menuMobile')

@include('landing.layouts.partials.slider')

@include('landing.layouts.partials.courses')

@include('landing.layouts.partials.videoBanner')

@include('landing.layouts.partials.articles')

@include('landing.layouts.partials.discussion')

@include('landing.layouts.partials.footer')

<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>

<div id="dropDownSelect1"></div>

@include('landing.layouts.partials.modalVideo')

@include('landing.layouts.partials.scripts')

</body>
</html>
