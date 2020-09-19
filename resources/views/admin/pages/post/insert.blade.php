@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-10">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card ispis">
                        <h5 class="card-header">Unos posta</h5>
                        <div class="card-body izmena-posta">
                            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (session()->has('poruka'))
                                    <div class="alert">
                                        <ul>
                                            <h1 class="h4">{{session('poruka')}}</h1>
                                        </ul>
                                    </div>
                                @endif
                                {{session()->forget('poruka')}}

                                <div class="form-group">
                                    <label for="title" class="col-form-label">Unesite naslov</label>
                                    <input id="title" name="title" type="text" class="form-control">
                                    <input type="hidden" name="user" value="{{session('korisnik')->id}}">
                                </div>
                                <div class="form-group">
                                    <textarea id="summernote" class="form-control" name="content"  placeholder="">Unesite tekst posta</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="input-select">Izaberite kategoriju posta</label>
                                    <select class="form-control" id="input-select" name="cat-id">
                                        <option value="0">Izaberite</option>
                                        @foreach($kategorije as $k)
                                            <option value="{{$k->id}}">{{$k->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="picture">Unesite sliku posta</label>
                                        <input id="picture" name="picture" type="file"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input  type="submit" class="btn btn-primary" name="btnInsert" value="Unesi"/>
                                        <input  type="reset" class="btn btn-danger" name="btnReset" value="Poništi"/>
                                    </div>
                                </div>
                            </form>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        <h1 class="h4">Greške</h1>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic form  -->
        </div>
    </div>
@endsection