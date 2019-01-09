@extends('layouts.home')
@section('title', 'Tempat wisata')
@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center">
      <h4 class="m-0"><i class="fa fa-building-o fa-lg"></i>&nbsp;Fasilitas Wisata</h4>
      <form action="" method="get">
        <div class="input-group">
          <input name="q" value="{{ request()->q }}" type="text" placeholder="Cari tempat wisata" class="form-control">
          <div class="input-group-append"><button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button></div>
        </div>
      </form>
    </div>
    <hr>
    <div class="card-columns">
        @foreach ($facilities as $site)  
        <div class="card">
          <a href="{{ route('root.site-show', ['slug' => $site->slug]) }}"><img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" alt="" class="card-img-top"></a>
          <div class="card-body">
            <h4 class="m-0">{{ $site->name }}</h4>
            <p class="small text-muted">{{ $site->site_type->name }}</p>
            <p class="m-0">{{ $site->description }}</p>
          </div>
        </div>
        @endforeach
    </div>
    {!! $facilities->appends(request()->q)->links() !!}
@endsection