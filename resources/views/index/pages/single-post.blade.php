@extends('layouts.index')
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{$vest->categories->id}}">{{$vest->categories->id}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$vest->title}}</li>
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
                    <img src="{{asset('/images/news') . "/" . $vest->picture->path}}" alt="{{$vest->picture->alt}}">
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
                            <a href="#" class="post-cata cata-sm cata-danger">{{$vest->categories->title}}</a>
                            <a href="{{route('single.news',$vest->id)}}" class="post-title mb-2">{{$vest->title}}</a>

                            <div class="d-flex justify-content-between mb-30">
                                <div class="post-meta d-flex align-items-center">
                                    <a href="#" class="post-author">{{$vest->user->name . " " . $vest->user->surname}}</a>
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                    <a href="#" class="post-date">{{$vest->created_at}}</a>
                                </div>
                                <div class="post-meta d-flex">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{$vest->brKomentara}}</a>
                                </div>
                            </div>
                        </div>

                        {{$vest->content}}

                        <!-- Comment Area Start -->
                        <div class="comment_area clearfix mb-50">

                            <!-- Section Title -->
                            <div class="section-heading style-2">
                                <h4>Comment</h4>
                                <div class="line"></div>
                            </div>

                            <ul id="comments">
                                @if(count($vest->comments)==0)
                                    <li class="list-group-item">Za ovu vest nema komentara</li>
                                @else
                                    @foreach($vest->comments as $com)

                                    <!-- Single Comment Area -->
                                        <li class="single_comment_area">
                                            <!-- Comment Content -->
                                            <div class="comment-content d-flex">
                                                <!-- Comment Meta -->
                                                <div class="comment-meta">
                                                    <a href="#" class="comment-date">{{$com->created_at}}</a>
                                                    <h6>{{$com->name}} {{$com->surname}}</h6>
                                                    <p>{{$com->pivot->content}}</p>
                                                    @if(session()->has('korisnik'))
                                                        @if(session('korisnik')->role->id == 1)
                                                            <input type="hidden" id="admin" value="{{session('korisnik')->id}}">
                                                            <a href="#" class="btn btn-danger delete-comment-admin" data-id="{{$com->pivot->id}}">Obriši komentrar</a>
                                                            @continue
                                                        @elseif((session('korisnik')->id == $com->id))
                                                            <a href="#" class="btn btn-danger delete-comment" data-id="{{$com->pivot->id}}">Obriši komentrar</a>
                                                            <input type="hidden" id="admin" value="0">
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- Post A Comment Area -->
                        <div class="post-a-comment-area">

                            <!-- Section Title -->
                            <div class="section-heading style-2">
                                <h4>Ostavite komentar</h4>
                                <div class="line"></div>
                            </div>

                            <!-- Reply Form -->
                            <div class="contact-form-area">
                                <form>
                                    <div class="row">
                                        <div class="col-12">
                                            <textarea name="message" class="form-control" id="message" placeholder="Unesite komentar*"></textarea>

                                            @if(session()->has('korisnik'))
                                                <input type="hidden" name="userID" id="userID" value="{{session('korisnik')->id}}">
                                            @else
                                                <input type="hidden"  id="userID" value="0">
                                            @endif
                                            <input type="hidden" name="postID" id="postID" value="{{$vest->id}}">
                                        </div>
                                        <div class="col-12">
                                            <button  id="btnComment" class="btn vizew-btn mt-30" type="button">Postavi komentar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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