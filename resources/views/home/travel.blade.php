@extends('layouts.home')
@section('title', 'Tempat wisata')
@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center header-anim">
      <h4 class="m-0"><i class="fa fa-map-marker fa-lg"></i>&nbsp;Tempat Wisata</h4>
      <form action="" method="get">
        <div class="input-group">
          <input name="q" value="{{ request()->q }}" type="text" placeholder="Cari tempat wisata" class="form-control">
          <div class="input-group-append"><button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button></div>
        </div>
      </form>
    </div>
    <hr>
    <div class="card-columns">
        @foreach ($sites as $site)  
        <div class="card shadow-sm anim">
          <a href="{{ route('root.site-show', ['slug' => $site->slug]) }}"><img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" alt="" class="card-img-top"></a>
          <div class="card-body">
            <a href="{{ route('root.site-show', ['slug' => $site->slug]) }}"><h4 class="m-0">{{ $site->name }}</h4></a>
            <p class="small text-muted">{{ $site->site_type->name }} | {{ $site->travel_type->name }}</p>
            <p class="m-0">{{ $site->description }}</p>
          </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex flex-row justify-content-center align-items-center anim">
      {!! $sites->appends(request()->q)->links() !!}
    </div>
@endsection