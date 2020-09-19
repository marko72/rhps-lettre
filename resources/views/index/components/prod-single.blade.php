<!-- Single Post Area -->
<div class="single-post-area style-2">
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <!-- Post Thumbnail -->
            <div class="post-thumbnail">
                <img src="{{asset('/images/news')}}{{'/'.$v->picture->path}}" alt="{{strtolower(substr($v->title,0,25))}}">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <!-- Post Content -->
            <div class="post-content mt-0">
                <a href="#" class="post-cata cata-sm cata-success">{{$v->categories->title}}</a>
                <a href="{{route('single.news',$v->id)}}" class="post-title mb-2">{{$v->title}}</a>
                <div class="post-meta d-flex align-items-center mb-2">
                    <a href="#" class="post-author">{{$v->user->name}} {{$v->user->surname}}</a>
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    <a href="#" class="post-date">{{$v->created_at}}</a>
                </div>
                <p class="mb-2">{{substr($v->content,0,255)}}</p>
                <div class="post-meta d-flex">
                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> {{$v->brKomentara}}</a>

                </div>
            </div>
        </div>
    </div>
</div>