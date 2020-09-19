@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-10">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Unos Kategorije</h5>
                        <div class="card-body">
                            <form>
                                <input type="hidden" id="_token" value="{{@csrf_token()}}">
                                <div class="form-group">
                                    <label for="title" class="col-form-label">Unesite naziv kategorije</label>
                                    <input id="title" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input  type="submit" class="btn btn-primary" id="btnInsert" name="btnInsert" value="Unesi"/>
                                        <input  type="reset" class="btn btn-danger" name="btnReset" value="Poništi"/>
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-danger" hidden="false" id="greske">
                                <h1>Greske</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic form  -->
        </div>
    </div>
@endsection
@section('javaScripts')
    @parent
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="{{asset('js\admin\category.js')}}"></script>



@endsection