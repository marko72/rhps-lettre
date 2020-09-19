<!DOCTYPE html>
<html lang="en">

<head>

    @include('index.inc.head')

</head>

<body>
    @include('index.inc.header')
    <!-- Navbar Area -->
    @include('index.inc.nav')
<!-- ##### Header Area End ##### -->

    @yield('content')

<!-- ##### Footer Area Start ##### -->
    @include('index.inc.footer')
<!-- ##### Footer Area End ##### -->

<!-- ##### All Javascript Script ##### -->
    @include('index.inc.javaScripts')
</body>

</html>