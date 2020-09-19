@extends('layouts.index')
@section('search')
    <div class="top-search-area">
        <form action="index.html" method="post">
            <input type="search" name="top-search" id="topSearch" placeholder="Search...">
            <button type="submit" id="pretrazi" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            <input type="hidden" id="search" value="0">
        </form>
    </div>
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
                        <li class="breadcrumb-item"><a href="{{route('news')}}">Sve vesti</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Archive List Posts Area Start ##### -->
<div class="vizew-archive-list-posts-area mb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div id="news">
                    @foreach($vesti as $v)
                        @component('index.components.prod-single',['v'=>$v])
                        @endcomponent
                    @endforeach
                </div>
                <!-- Pagination -->
                <nav class="mt-50">
                    <ul class="pagination justify-content-center paginacija">
                        @for($i=0; $i<$brStrana; $i++)
                            @if($i==0)
                                <li class="page-item active"><a class="page-link page" href="#" data-id="{{(($i+1)-1)*5}}">{{$i+1}}</a></li>
                                @continue
                            @endif
                                <li class="page-item"><a class="page-link page" href="#" data-id="{{(($i+1)-1)*5}}">{{$i+1}}</a></li>
                        @endfor
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Archive List Posts Area End ##### -->
@endsection
@section('javaScripts')
    @parent
    <script src="{{asset('/js/paginateNews.js')}}"></script>
@endsection