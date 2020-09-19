@extends('layouts.index')
@section('content')

<!-- ##### Vizew Post Area Start ##### -->
<section class="vizew-post-area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="all-posts-area">
                    <!-- Section Heading -->
                    <div class="section-heading style-2">
                        <h4>Najnovije vesti</h4>
                        <div class="line"></div>
                    </div>

                    <!-- Featured Post Slides -->
                    <div class="featured-post-slides owl-carousel mb-30">
                    @foreach($najnovije as $n)
                        <!-- Single Feature Post -->
                        @component('index.components.slider',['n'=>$n])
                        @endcomponent
                    @endforeach
                    </div>
                    <div class="row">
                        @foreach($poKategoriji as $pk)
                        <div class="col-12 col-lg-6">
                            <!-- Section Heading -->
                            <div class="section-heading style-2">
                                <h4>{{$pk->title}}</h4>
                                <div class="line"></div>
                            </div>
                            @foreach($pk->posts as $n)
                            <!-- Sports Video Slides -->
                            <div class="sport-video-slides owl-carousel mb-50">
                                <!-- Single Blog Post -->
                                <div class="single-post-area">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/images/news') . "/" . $n->picture->path}}" alt="{{strtolower(substr($n->title,0,25))}}">
                                    </div>

                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="{{route('single.news',$n->id)}}" class="post-title">{{$n->title}}</a>
                                        <div class="post-meta d-flex">
                                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{count($n->comments)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                            {{ $poKategoriji->links() }}
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 col-lg-4">
                <div class="sidebar-area">

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget followers-widget mb-50">
                        <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span class="counter">198</span><span>Fan</span></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span class="counter">220</span><span>Followers</span></a>
                        <a href="#" class="google"><i class="fa fa-google" aria-hidden="true"></i><span class="counter">140</span><span>Subscribe</span></a>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Najpopularnije vesti</h4>
                            <div class="line"></div>
                        </div>
                        @foreach($najpopularnije as $pop)
                        <!-- Single Blog Post -->
                            @component('index.components.most-pop',['pop'=>$pop])
                            @endcomponent
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->
@endsection