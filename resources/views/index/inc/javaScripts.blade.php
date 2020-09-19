@section('javaScripts')
<!-- Popper js -->
<script src="{{asset('/index/js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('/index/js/bootstrap/bootstrap.min.js')}}"></script>
<!-- All Plugins js -->
<script src="{{asset('/index/js/plugins/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{asset('/index/js/active.js')}}"></script>
<script>
    const BASE_URL = '{{url('/')}}';
</script>
@show