@extends('layouts.dashboard')

@section('title', 'Halaman Utama')

@section('content')
    <div class="container-fluid mb-5">
      <div class="card">
        <div class="card-body">
          <h4 class="m-0"><i class="fa fa-dashboard fa-lg"></i>&nbsp;Halaman Utama</h4>
        </div>
      </div>
      {{--  --}}
      <div class="row">
        {{--  --}}
        <div class="col-12">
          <hr>
        </div>
        <div class="col-md-3">
          <div class="card mt-2 mb-1 bg-warning text-dark p-relative o-hidden">
            <div class="card-body">
              <h1 class="m-0">{{ $main }}</h1>
              <p class="m-0">Berita</p>
              <i class="fa fa-newspaper-o fa-lg card-icon"></i>
            </div>
            <div class="card-footer">
              <a href="#" class="text-dark">Detail</a>
            </div>
          </div>
        </div>
        {{--  --}}
        <div class="col-md-3">
          <div class="card mt-2 mb-1 bg-danger text-white p-relative o-hidden">
            <div class="card-body">
              <h1 class="m-0">{{ $site }}</h1>
              <p class="m-0">Tempat Wisata</p>
              <i class="fa fa-map-marker fa-lg card-icon"></i>
            </div>
            <div class="card-footer">
              <a href="#" class="text-white">Detail</a>
            </div>
          </div>
        </div>
        {{--  --}}
        <div class="col-md-3">
          <div class="card mt-2 mb-1 bg-primary text-white p-relative o-hidden">
            <div class="card-body o-hidden">
              <h1 class="m-0">{{ $pics }}</h1>
              <p class="m-0">Foto (Gallery)</p>
              <i class="fa fa-picture-o fa-lg card-icon"></i>
            </div>
            <div class="card-footer">
              <a href="#" class="text-white">Detail</a>
            </div>
          </div>
        </div>
        {{--  --}}
        <div class="col-md-3">
          <div class="card mt-2 mb-1 bg-dark text-white p-relative o-hidden">
            <div class="card-body">
              <h1 class="m-0">{{ $facilities }}</h1>
              <p class="m-0">Fasilitas Wisata</p>
              <i class="fa fa-building-o fa-lg card-icon"></i>
            </div>
            <div class="card-footer">
              <a href="#" class="text-white">Detail</a>
            </div>
          </div>
        </div>
        {{--  --}}
        <div class="col-12">
          <hr>
        </div>
        <div class="col-md-6 mt-1 mb-2">
          <div class="card o-hidden">
            <div class="card-header o-hidden d-flex flex-row justify-content-between align-items-center">
              <p class="m-0 card-title d-inline-block"><i class="fa fa-info-circle fa-lg"></i>&nbsp;Info Halaman Utama</p>
              <button class="btn btn-outline-success btn-sm d-inline-block"><i class="fa fa-edit fa-fw"></i>&nbsp;Ganti info</button>
            </div>
            <div class="card-body">
              <h4>{{ $info->name }}</h4>
              <p class="text-justify">{{ str_limit($info->content, 90) }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-1 mb-2">
          <div class="card">
            <div class="card-header o-hidden d-flex flex-row justify-content-between align-items-center">
                <p class="m-0 card-title d-inline-block"><i class="fa fa-bar-chart-o fa-lg"></i>&nbsp;Pengunjung</p>
            </div>
            <div class="card-body">
              Pengunjung Banyak
            </div>
          </div>
        </div>
      </div>
      {{--  --}}
    </div>
@endsection