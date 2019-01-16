@extends('layouts.home')
@section('title', $site->name)

@section('content')
    {{-- {{ dd($site->facilities) }} --}}
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      @if ($site->travel_type !== null)
        <a href="{{ route('root.sites') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-map-markerfa-lg"></i>&nbsp;Tempat Wisata</h4>
      @else
        <a href="{{ route('root.facilities', ['nama' => str_slug(strtolower($site->site_type->name))]) }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-building-o fa-lg"></i>&nbsp;Fasilitas Wisata</h4>
      @endif
    </div>
    <div class="row">
      <div class="col-md-8">
        {{--  --}}
        <div class="card mb-5">
          <div class="card-body">
            <h4 class="m-0">{{ $site->name }}</h4>
            <p class="m-0 small text-muted">{{ $site->site_type->name }} | {{ $site->address }}</p>
          </div>
          <img src="{{ asset('storage/img/' . $site->site_pictures->first()->photo) }}" title="{{ $site->title }}" alt="" class="card-img rounded-0">
          <div class="card-body">
            {{-- <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Alamat</span>
              </div>
              <input type="text" readonly value="{{ $site->address }}" class="form-control">
            </div> --}}
            @if ($site->facilities->count() > 0)
              <p class="m-0">Fasilitas :</p>
              <ul class="mb-0">
                @foreach ($site->facilities as $item)
                    <li>{{ $item->facility }}</li>
                @endforeach
              </ul>
            @endif
            <p class="text-justify">{{ $site->description }}</p>
          </div>
        </div>
        {{--  --}}
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body p-2">
            @if ($site->travel_type !== null)
              <h5 class="card-title m-0">Tempat Wisata Lainnya</h5>
              @else  
              <h5 class="card-title m-0">Fasilitas Wisata Lainnya</h5>
            @endif
          </div>
          <div class="list-group o-hidden list-group-flush">
            @foreach ($sites as $item)
              <a href="{{ route('root.facilities-show', ['slug' => $item->slug, 'name' => str_slug(strtolower($item->site_type->name))]) }}" class="list-group-item anim list-group-action">
                <h5 class="m-0">{{ $item->name }}</h5>
                <p class="m-0 text-muted small">{{ $item->address }}</p>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
@endsection