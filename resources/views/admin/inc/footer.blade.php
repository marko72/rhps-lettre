<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
@section('javaScripts')
<script>
    const BASE_URL = "{{url('/')}}";
</script>
<!-- bootstap bundle js -->
<script src="{{asset("admin/assets/vendor/bootstrap/js/bootstrap.bundle.js")}}"></script>
<!-- slimscroll js -->
<script src="{{asset("admin/assets/vendor/slimscroll/jquery.slimscroll.js")}}"></script>
<!-- main js -->
<script src="{{asset("admin/assets/libs/js/main-js.js")}}"></script>

<!-- sparkline js -->
<script src="{{asset("admin/assets/vendor/charts/sparkline/jquery.sparkline.js")}}"></script>
<!-- chart c3 js -->
<script src="{{asset("admin/assets/vendor/charts/c3charts/c3.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js")}}"></script>
<script src="{{asset("admin/assets/vendor/charts/c3charts/C3chartjs.js")}}"></script>
@show
</body>

</html>