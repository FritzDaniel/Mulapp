<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/jvectormap/jquery-jvectormap.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/dist/css/AdminLTE.min.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('assets/adminLTE/dist/css/skins/_all-skins.min.css') }}">

@yield('css')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
    .jqstooltip
    {
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0,0,0,0.6);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        box-sizing: content-box;z-index: 10000;
    }
    .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
    }</style>
<style id="__web-inspector-hide-shortcut-style__" type="text/css">
    .__web-inspector-hide-shortcut__,
    .__web-inspector-hide-shortcut__ *,
    .__web-inspector-hidebefore-shortcut__::before,
    .__web-inspector-hideafter-shortcut__::after
    {
        visibility: hidden !important;
    }
</style>