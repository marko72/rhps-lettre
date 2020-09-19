@extends('layouts.admin')
@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- data table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Sve kategorije</h5>
                <p>This example shows DataTables and the Buttons extension being used with the Bootstrap 4 framework providing the styling.</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <thead>
                        <tr>
                            <th>RB</th>
                            <th>Naziv</th>
                            <th>Obriši</th>
                        </tr>
                        </thead>
                        <tbody id="tabelaKategorije">
                        @if($kategorije)
                            <?php
                                    $br=1;
                            ?>
                            @foreach($kategorije as $k)
                        <tr>
                            <td>{{$br++}}</td>
                            <td>{{$k->title}}</td>
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
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="{{asset('js\admin\category.js')}}"></script>



@endsection