@extends('layouts.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">SVI POSTOVI</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <thead>
                            <tr>
                                <th>RB</th>
                                <th>Naslov</th>
                                <th>Sadržaj</th>
                                <th>Slika</th>
                                <th>Postavio</th>
                                <th>Kategorija</th>
                                <th>Postavljeno</th>
                                <th>Izmenjeno</th>
                                <th>Izmeni</th>
                                <th>Izbriši</th>
                            </tr>
                            </thead>
                            <tbody id="tabelaPostovi">
                            {{--{{dd($postovi->name)}}--}}
                            @if($postovi)
                                <?php
                                $br=1;
                                ?>
                                @foreach($postovi as $p)
                                    <tr>
                                        <td>{{$br++}}</td>
                                        <td>{{$p->title}}</td>
                                        <td style="max-height: 100px">{{$p->content}}</td>
                                        <td><img class="img-thumbnail" src="{{asset('/images/news').'/'.$p->picture->path}}" alt=""></td>
                                        <td>{{$p->user->name}} {{$p->user->surname}}</td>
                                        <td>{{$p->categories->title}}</td>
                                        <td>{{$p->created_at}}</td>
                                        <td>{{$p->updated_at}}</td>
                                        <td><a href="{{route('posts.edit',$p->id)}}" class="btn btn-primary btnUpdate">Izmeni</a></td>
                                        <td><a href="#" class="btn btn-danger btnDelete" data-id="{{$p->id}}">Obriši</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <ul class="pagination" role="navigation">
                            @for($i=0;$i<$brojStrana;$i++)
                                @if($i==0)
                                    <li class="page-item active page" aria-current="page" data-id="{{(($i+1)-1)*3}}"><span class="page-link">{{$i+1}}</span></li>
                                @else
                                    <li class="page-item page" aria-current="page" data-id="{{(($i+1)-1)*3}}"><span class="page-link">{{$i+1}}</span></li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end data table  -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('javaScripts')
    @parent
    <script src="{{asset('js/admin/post.js')}}"></script>
@endsection