<div class="single-blog-post d-flex">
    <div class="post-thumbnail">
        <img src="{{asset('/images/news') . "/" . $pop->picture->path}}" alt="{{strtolower(substr($pop->title,0,25))}}">
    </div>
    <div class="post-content">
        <a href="{{route('single.news',$pop->id)}}" class="post-title">{{$pop->title}}</a>
        <div class="post-meta d-flex justify-content-between">
            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{$pop->brKomentara}}</a>
        </div>
    </div>
</div>