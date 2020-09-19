<div class="vizew-main-menu" id="sticker">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">

            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="vizewNav">

                <!-- Nav brand -->
                <a href="" class="nav-brand"><img src="img/core-img/logo.png" alt=""></a>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <div class="classy-menu">

                    <!-- Close Button -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{route('contact')}}">Kontakt</a></li>
                            <li><a href="{{route('news')}}">Sve vesti</a></li>
                            @foreach($kategorije as $kat)
                                <li><a href="{{route('news.category',$kat->id)}}">{{$kat->title}}</a></li>
                            @endforeach
                            @if(session()->has('korisnik'))
                                @if(session('korisnik')->role->id == 1)
                                    <li><a href="{{route('admin')}}">Admin</a></li>
                                @endif
                                <li><a href="{{route('logout')}}">Logout</a></li>
                            @else
                                <li><a href="{{route('showLogin')}}">Login</a></li>
                                <li><a href="{{route('user.create')}}">Registracija</a></li>
                            @endif
                            <li><a href="{{route('autor')}}">Autor</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
    </div>
</div>
</header>