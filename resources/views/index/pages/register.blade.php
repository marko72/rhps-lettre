@extends('layouts.index')
@section('content')
    <!-- ##### Login Area Start ##### -->
    <div class="vizew-login-area section-padding-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login-content">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h4>Registracija</h4>
                            <div class="line"></div>
                        </div>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="tbName" placeholder="Unesite vaše ime" name="name">
                            </div>
                            <div class="form-group">
                                <input type='text' class="form-control" id="tbSurname" placeholder="Unesite vaše prezime" name="surname">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="tbEmail" placeholder="Unesite vaš E-mail" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="tbPasswd" placeholder="Lozinka" name="passwd">
                            </div>
                            <button type="button" id="btnReg" class="btn vizew-btn w-100 mt-30">Registrer</button>
                        </form>
                        <div>
                            <ul class="greske list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Login Area End ##### -->

@endsection
@section('javaScripts')
    @parent
    <script src="{{asset('js/user.js')}}"></script>
@endsection