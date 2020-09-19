<div class="single-feature-post video-post bg-img" style="background-image: url({{asset('/images/news') . "/" . $n->picture->path}});">


    <!-- Post Content -->
    <div class="post-content">
        <a href="#" class="post-cata">{{$n->categories->title}}</a>
        <a href="{{route('single.news',$n->id)}}" class="post-title">{{$n->title}}</a>
        <div class="post-meta d-flex">
            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{$n->brKomentara}}</a>
        </div>
    </div>
</div>


