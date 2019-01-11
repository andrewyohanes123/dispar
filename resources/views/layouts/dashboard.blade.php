<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base-url" content="{{ url('/') }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @yield('meta')
  <title>@yield('title') | {{ config('app.name', 'Dashboard - Dinas Pariwisata Kota Manado') }}</title>  
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dark.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a href="javascript:void(0)" class="navbar-brand col-sm-3 col-md-2 mr-0">{{ config('app.name', 'Kelurahan') }}</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
          <a href="javascript:void(0)" class="nav-link"><i class="fa fa-user-circle-o fa-md"></i>&nbsp;{{ Auth::user()->name }}</a>
      </li>
    </ul>    
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('dashboard.main') }}" class="nav-link {{ (Route::current()->getName() === 'dashboard.main') ? 'active' : '' }}"><i class="fa fa-dashboard fa-md"></i>&nbsp;Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('berita.index') }}" class="nav-link {{ (Route::current()->getName() === 'berita.index') ? 'active' : '' }}"><i class="fa fa-newspaper-o fa-md"></i>&nbsp;Berita</a></li>
            <li class="nav-item"><a href="{{ route('tempat-wisata.index') }}" class="nav-link {{ (Route::current()->getName() === 'tempat-wisata.index') ? 'active' : '' }}"><i class="fa fa-map-marker fa-md"></i>&nbsp;Tempat Wisata</a></li>
            <li class="nav-item"><a href="{{ route('fasilitas-wisata.index') }}" class="nav-link {{ (Route::current()->getName() === 'fasilitas-wisata.index') ? 'active' : '' }}"><i class="fa fa-building-o fa-md"></i>&nbsp;Fasilitas Wisata</a></li>
            <li class="nav-item"><a href="{{ route('kalender-kegiatan.index') }}" class="nav-link {{ (Route::current()->getName() === 'kalender-kegiatan.index') ? 'active' : '' }}"><i class="fa fa-calendar fa-md"></i>&nbsp;Kalender Kegiatan</a></li>
          </ul>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <a id="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#"><i class="fa fa-sign-out fa-md text-muted"></i>&nbsp;Logout</a>
          </h6>
          <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </nav>
      <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="height: 70px;" ></div>
        @yield('content')
        <div class="bg-dark p-absolute p-2 text-center">
          <footer class="m-0 text-white">{{ config('app.name') }} | &copy;{{ date('Y') }}</footer>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ mix('js/app.js') }}" defer></script>    
  <script src="{{ asset('js/flatpickr') }}"></script>  
  <script src="{{ asset('js/summernote-bs4.js') }}" defer></script>    
  <script src="{{ asset('js/main.js') }}" defer></script>    
  @yield('scripts')
</body>
</html>