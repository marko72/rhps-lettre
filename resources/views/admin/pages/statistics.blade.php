@extends('layouts.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">AKTIVNOSTI KORISNIKA</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="date" class="col-form-label">Unesite tekst za pretragu</label>
                        <input id="search" name="search" type="text" class="form-control">
                        <input type="button" id="pretrazi" value="Pretraži" class="btn btn-dark">
                        <input type="hidden" value="0" id="pretraga">
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                            <tr>
                                <th>RB</th>
                                <th>Aktivnost</th>
                            </tr>
                            </thead>
                            <tbody id="tabelaAktivnosti">
                            @if($aktivnosti)
                                <?php
                                $br=1;
                                ?>
                                @foreach($aktivnosti as $a)
                                    <tr>
                                        <td>{{$br++}}</td>
                                        <td>Korisnik {{$a->user->name}} {{$a->user->surname}} {{$a->action}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <ul class="pagination" role="navigation">
                            @for($i=0;$i<$brojStrana;$i++)
                                @if($i==0)
                                <li class="page-item active page" aria-current="page" data-id="{{(($i+1)-1)*5}}"><span class="page-link">{{$i+1}}</span></li>
                                @else
                                <li class="page-item page" aria-current="page" data-id="{{(($i+1)-1)*5}}"><span class="page-link">{{$i+1}}</span></li>
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
    <script src="{{asset('js/admin/paginacijaAdmin.js')}}"></script>
@endsection

