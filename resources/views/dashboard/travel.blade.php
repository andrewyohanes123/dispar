@extends('layouts.dashboard')
@section('title', 'Tempat wisata')
@section('content')
    {{-- <div class="d-flex flex-row justify-content-between align-items-center">
      <h4 class="m-0"><i class="fa fa-map-marker fa-lg"></i>&nbsp;Tempat Wisata | <a href="{{ route('tempat-wisata.create') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Tambah tempat wisata</a></h4>
      <form action="" method="get">
        <div class="input-group">
          <input name="q" value="{{ request()->q }}" type="text" placeholder="Cari tempat wisata" class="form-control">
          <div class="input-group-append"><button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button></div>
        </div>
      </form>
    </div>
    <hr> --}}
    <div id="travel-site"></div>
    {{-- <div class="card-columns"> --}}
        {{-- @foreach ($sites as $site)  
        <div class="card">
          <img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" alt="" class="card-img-top">
          <div class="card-body">
            <h4 class="m-0">{{ $site->name }}</h4>
            <p class="small text-muted">{{ $site->site_type->name }} | {{ $site->travel_type->name }}</p>
            <p class="m-0">{{ $site->description }}</p>
            <hr>
            <a href="#" class="btn btn-warning btn-sm" title="Edit {{ $site->name }}" ><i class="fa fa-edit fa-lg"></i></a>
            <a href="#" class="btn btn-danger btn-sm" title="Hapus {{ $site->name }}?" ><i class="fa fa-remove fa-lg"></i></a>
            <a href="#" class="btn btn-primary btn-sm" title="Preview {{ $site->name }}" ><i class="fa fa-eye fa-lg"></i></a>
          </div>
        </div>
        @endforeach --}}
    {{-- </div> --}}
    {{-- {!! $sites->appends(request()->q)->links() !!} --}}
@endsection