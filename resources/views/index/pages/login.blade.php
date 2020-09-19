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
                            <h4>Logovanje</h4>
                            <div class="line"></div>
                        </div>
                        @if(session('poruka'))
                            <div class="alert alert-danger">
                                <ul>
                                    <h4>Greške</h4>
                                    @if(is_array(session('poruka')))
                                        @foreach (session('poruka') as $p)
                                            <li>{{ $p }}</li>
                                        @endforeach
                                    @else
                                        <li>{{ session('poruka') }}</li>
                                    @endif
                                </ul>
                            </div>
                            {{session()->forget('poruka')}}
                        @endif
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="Unesite vaš E-mail" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="passwd" placeholder="Lozinka" name="passwd">
                            </div>
                            <button type="submit" class="btn vizew-btn w-100 mt-30">Login</button>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <h4>Greške</h4>
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
    </div>
    <!-- ##### Login Area End ##### -->

@endsection