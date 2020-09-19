@extends('layouts.index')
@section('title')
    <title>Vizew - Blog &amp; Autor</title>
@endsection
@section('content')
    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="vizew-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Autor</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->


    <!-- ##### Post Details Area Start ##### -->
    <section class="post-details-area mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="post-details-thumb mb-50">
                        <img src="{{--{{asset('/images/news') . "/" . --}}{{--$vest->picture->path}}--}}" alt="{{--{{$vest->picture->alt}}--}}">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Post Details Content Area -->
                <div class="col-12 col-lg-8 col-xl-7">
                    <div class="post-details-content">
                        <!-- Blog Content -->
                        <div class="blog-content">

                            <!-- Post Content -->
                            <div class="post-content mt-0">
                                <p>Ja sam Marko Radivojevic student sam Visoke ICT  škole u beogradu i ovaj sajt je moj prvi sajt odrađen u PHP-ovom Laravel Framework-u</p>

                                <a href="dokumentacija.pdf" class="btn btn-success">Dokumentacija</a>

                            </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### Post Details Area End ##### -->
@endsection
@section('javaScripts')
    @parent
    <script src="{{asset('/js/comment.js')}}"></script>
@endsection