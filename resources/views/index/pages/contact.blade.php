@extends('layouts.index')
@section('content')
<!-- ##### Contact Area Start ##### -->
<section class="contact-area mb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 col-lg-8">
                <!-- Section Heading -->
                <div class="section-heading style-2">
                    <h4>Contact</h4>
                    <div class="line"></div>
                </div>

                @if(session()->has('poruka'))
                    <h1>Hvala sto ste nas kontaktirali, odgovorićemo u najkraćem roku!</h1>
                @endif
                {{session()->forget('poruka')}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Contact Form Area -->
                <div class="contact-form-area mt-50">
                    <form action="{{route('send.email')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Ime*</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail*</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="message">Poruka*</label>
                            <textarea name="message" class="form-control" id="message" namcols="30" rows="10"></textarea>
                        </div>
                        <button class="btn vizew-btn mt-30" type="submit">Pošaljite</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->
@endsection