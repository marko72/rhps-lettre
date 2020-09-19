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
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>E-mail</th>
                                <th>Uloga</th>
                                <th>Registrovan</th>
                                <th>Izmenjen</th>
                                <th>Izmeni</th>
                                <th>Izbriši</th>
                            </tr>
                            </thead>
                            <tbody id="tabelaKorisnici">
                            {{--{{dd($postovi->name)}}--}}
                            @if($korisnici)
                                <?php
                                $br=1;
                                ?>
                                @foreach($korisnici as $k)
                                    <tr>
                                        <td>{{$br++}}</td>
                                        <td>{{$k->name}}</td>
                                        <td>{{$k->surname}}</td>
                                        <td>{{$k->email}}</td>
                                        <td>
                                            <select class="form-control custom-select " id="ddlUloga" name="ddlUloga">
                                                <option value="1" {{($k->role->id==1)?"selected":""}}>Admin</option>
                                                <option value="2" {{($k->role->id==2)?"selected":""}}>Korisnik</option>
                                            </select>
                                        </td>
                                        <td>{{$k->created_at}}</td>
                                        <td>{{$k->updated_at}}</td>
                                        <td><a href="#" class="btn btn-primary btnUpdate" data-id="{{$k->id}}">Izmeni</a></td>
                                        <td><a href="#" class="btn btn-danger btnDelete" data-id="{{$k->id}}">Obriši</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
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
    <script src="{{asset('js/admin/user.js')}}"></script>
@endsection