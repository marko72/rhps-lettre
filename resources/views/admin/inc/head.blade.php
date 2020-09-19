<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link href="{{asset('admin/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('admin/assets/libs/css/style.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/charts/chartist-bundle/chartist.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/charts/morris-bundle/morris.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/charts/c3charts/c3.css')}}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
<script src="{{asset("admin/assets/vendor/jquery/jquery-3.3.1.min.js")}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<title>Admin panel</title>