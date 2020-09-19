<meta charset="UTF-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- Title -->
@yield('title')


<!-- Favicon -->
<link rel="icon" href="{{asset('/images/img/core-img/favicon.ico')}}">

<!-- Stylesheet -->
<link rel="stylesheet" href="{{asset('index/style.css')}}">
<!-- jQuery-2.2.4 js -->
<script src="{{asset('/index/js/jquery/jquery-2.2.4.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>