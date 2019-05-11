<script src="{{ asset('assets/adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('assets/adminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/bower_components/chart.js/Chart.js') }}"></script>
<script src="{{ asset('js/submit.js') }}"></script>
<script src="{{ asset('assets/adminLTE/plugins/pace/pace.min.js') }}"></script>

<script>
    $(document).ajaxStart(function() { Pace.restart(); });
</script>
@yield('js')