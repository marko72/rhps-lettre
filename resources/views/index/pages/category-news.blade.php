@extends("layouts.index")
@section('search')
    <div class="top-search-area">
        <form action="index.html" method="post">
            <input type="search" name="top-search" id="topSearch" placeholder="Search...">
            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            <input type="hidden" value="0" id="pretraga">
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
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Početna</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$kategorija->title}}</a></li>
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
                <!-- Archive Catagory & View Options -->
                <div class="archive-catagory-view mb-50 d-flex align-items-center justify-content-between">
                    <!-- Catagory -->
                    <div class="archive-catagory">
                        <h4><i class="fa fa-coulture" aria-hidden="true"></i> {{$kategorija->title}} </h4>
                    </div>
                </div>
                @foreach($vesti as $v)
                    @component('index.components.prod-single',['v'=>$v])
                    @endcomponent
                @endforeach


                <!-- Pagination -->
                <div id="pagination">
                    {{ $vesti->links() }}
                </div>

            </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Archive List Posts Area End ##### -->
@endsection
