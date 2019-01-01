@extends('layouts.home')
@section('title', $site->name)

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      <a href="{{ route('root.sites') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-map-marker-o fa-lg"></i>&nbsp;Tempat Wisata</h4>
    </div>
    <div class="card mb-5">
      <div class="card-body">
        <h4 class="m-0">{{ $site->name }}</h4>
        <p class="m-0 small text-muted">{{ $site->site_type->name }}</p>
      </div>
      <img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" title="{{ $site->title }}" alt="" class="card-img rounded-0">
      <div class="card-body">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <span class="input-group-text">Alamat</span>
          </div>
          <input type="text" readonly value="{{ $site->address }}" class="form-control">
        </div>
        <p class="text-justify">{{ $site->description }}</p>
      </div>
    </div>
@endsection