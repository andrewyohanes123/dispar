<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel fixed-top p-0">
        <a href="/" class="navbar-brand p-2">{{ config('app.name') }}</a>
        <button class="navbar-toggler" data-collapse="collapse" data-target="#menu"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (Route::current()->getName() === 'root') ? 'active' : '' }}"><a href="{{ route('root') }}" class="nav-link">Beranda</a></li>
                <li class="nav-item {{ (Route::current()->getName() === 'root.news') ? 'active' : '' }}"><a href="{{ route('root.news') }}" class="nav-link">Berita</a></li>
                <li class="nav-item {{ (Route::current()->getName() === 'root.sites') ? 'active' : '' }}"><a href="{{ route('root.sites') }}" class="nav-link">Tempat Wisata</a></li>
                <li class="nav-item dropdown {{ (Route::current()->getName() === 'root.sites') ? 'active' : '' }}">
                    <a href="#" id="dropdown" class="nav-link dropdown-toggle" data-toggle="dropdown">Fasilitas</a>
                    <div class="dropdown-menu">
                        @foreach ($facility as $item)
                            <a href="{{ route('root.facilities', ['nama' => str_slug(strtolower($item->name))]) }}" class="dropdown-item">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item {{ (Route::current()->getName() === 'root.galleries') ? 'active' : '' }}"><a href="{{ route('root.galleries') }}" class="nav-link">Gallery</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item"><a href="{{ route('dashboard.main') }}" class="nav-link">{{ Auth::user()->name }}</a></li>
                @else
                    <li class="nav-item"><a href="{{ url('/login') }}" class="nav-link">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="mt-4">
        @yield('banner')
        <div class="container pt-5">
            @yield('content')
        </div>
        <div class="container-fluid bg-dark text-white p-3">
            <div class="container">
                @include('home.footer')
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>