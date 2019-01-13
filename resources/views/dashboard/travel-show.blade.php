@extends('layouts.dashboard')
@section('title', $site->name)

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      <a href="{{ route('tempat-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-map-marker fa-lg"></i>&nbsp;Preview Tempat Wisata</h4>
    </div>
    <div class="row">
      <div class="col-md-8">
        {{--  --}}
        <div class="card mb-5">
          <div class="card-body position-relative">
            <a href="{{ route('tempat-wisata.edit', ['id' => $site->id]) }}" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-edit fa-lg"></i></a>
            <h4 class="m-0">{{ $site->name }}</h4>
            <p class="m-0 small text-muted">{{ $site->travel_type !== null ? $site->travel_type->name : $site->site_type->name }} | {{ $site->address }}</p>
          </div>
          <img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" title="{{ $site->title }}" alt="" class="card-img rounded-0">
          <div class="card-body">
            <p class="text-justify">{{ $site->description }}</p>
          </div>
        </div>
        {{--  --}}
      </div>
      {{--  --}}
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <p class="m-0">Tempat wisata lainnya</p>
          </div>
          <div class="list-group list-group-flush">
            @foreach ($sites as $item)                
            <a href="{{ route('tempat-wisata.show', ['id' => $item->id]) }}" class="list-group-item list-group-action">
              <h4 class="m-0">{{ $item->name }}</h4>
              <p class="small text-muted m-0">{{ $item->address }}</p>
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
@endsection