<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Laravel 7 前端</title> --}}
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
</head>
<body>
    <nav class="d-flex justify-content-between">
        <a href="{{ asset('/') }}"  class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></a>
        <ul class="d-flex flex-row align-items-center">
            <li><a href="{{ asset('/news') }}" target="_blank" rel="noopener noreferrer">News</a></li>
            <li><a href="#" target="_blank" rel="noopener noreferrer">About</a></li>
            <li><a href="#" target="_blank" rel="noopener noreferrer">Cantact</a></li>
            <a href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-cart3"></i></a>
            <a href="{{ asset('/login') }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-person-circle"></i></a>
        </ul>
    </nav>

    <main>
        @yield('main')
    </main>

    <footer class="d-flex flex-wrap">
        <div class="conpany">
            <p>熱血雞塊</p>
            <span>Air plant banjo lyft occupy retro adaptogen indego</span>
        </div>
        <div class="link">
            <p>CATEGORIES</p>
            <ul>
                <li><a href="">First Link</a></li>
                <li><a href="">Second Link</a></li>
                <li><a href="">Third Link</a></li>
                <li><a href="">Fourth Link</a></li>
            </ul>
        </div>
        <div class="link">
            <p>CATEGORIES</p>
            <ul>
                <li><a href="">First Link</a></li>
                <li><a href="">Second Link</a></li>
                <li><a href="">Third Link</a></li>
                <li><a href="">Fourth Link</a></li>
            </ul>
        </div>
        <div class="link">
            <p>CATEGORIES</p>
            <ul>
                <li><a href="">First Link</a></li>
                <li><a href="">Second Link</a></li>
                <li><a href="">Third Link</a></li>
                <li><a href="">Fourth Link</a></li>
            </ul>
        </div>
        <div class="link">
            <p>CATEGORIES</p>
            <ul>
                <li><a href="">First Link</a></li>
                <li><a href="">Second Link</a></li>
                <li><a href="">Third Link</a></li>
                <li><a href="">Fourth Link</a></li>
            </ul>
        </div>
        <div class="copyright">©2020 Tailblocks — @knyttneve</div>
        <div class="social-media d-flex justify-content-end">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
