<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <title>@yield('title')</title> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="summernote-bs5.css" rel="stylesheet"> -->
    <style>
        .note-btn.dropdown-toggle:after{
            content:none;
        }
    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand mr-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest

                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/admin/news') }}">最新消息管理</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('facility.index') }}">設施介紹管理</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    產品管理
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('products.index') }}">產品編輯</a>
                                    <a class="dropdown-item" href="{{ route('product-categories.index') }}">產品類別</a>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (Session('message'))
            <div class="container">
                <div class="alert {{ Session('color') }} mb-4 m-auto" role="alert">
                    {{ Session('message') }}
                </div>
            </div>
            @endif
            @yield('content')
            @yield('main')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="summernote-bs5.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#descripte').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    // upload image to server and create imgNode...
                    console.log(files);

                    // 圖片要發送到後端的路徑
                    let url = '{{route('tool.image-upload')}}';
                    // 利用JS建立一個form表單
                    let formData = new FormData();
                    // formDate.append(key, value);
                    // csrf token
                    formData.append('_token', '{{ csrf_token() }}')
                    // 圖片
                    formData.append('image', files[0]);

                    fetch(url, {
                        'method': 'post',
                        'body': formData
                    }).then((response) => {
                        return response.text();
                    }).then((data)=> {
                        console.log(data);
                        $('#content').summernote('insertImage', data);
                    })
                }
            }
        });

        // const deletebtns = document.querySelectorAll('.delete-btn');
        // deletebtns.forEach(deletebtn => {
        //     deletebtn.addEventListener('click', ()=> {
        //         if( Session('message') ){
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: '請確認',
        //                 text: '該類別尚有其他商品使用中!',
        //                 // footer: '<a href="">Why do I have this issue?</a>'
        //             })
        //         };
        //     })
        // });

    </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('js')
</body>
</html>
