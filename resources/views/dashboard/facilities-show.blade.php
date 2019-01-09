@extends('layouts.dashboard')
@section('title', $facility->name . ' | Fasilitas Wisata')

@section('content')
  <div class="d-flex flex-row justify-content-between align-items-center">
    <a href="{{ route('fasilitas-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-fw"></i>&nbsp;Kembali</a>
    <h4 class="m-0"><i class="fa fa-building-o fa-lg"></i>&nbsp;Fasilitas Wisata</h4>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <h4 class="m-0">{{ $facility->name }}</h4>
      <p class="text-muted small mb-1">{{ $facility->site_type->name }} - {{ $facility->address }}</p>
      @if ($facility->site_pictures->count() > 1)
        <div class="row no-gutters">
          @foreach ($facility->site_pictures as $i => $pic)
              <div class="{{ ($i + 1) === $facility->site_pictures->count() ? 'col-md-12' : 'col-md-6' }} o-hidden border-dark" style="max-height:300px !important;"><img src="{{ asset('/storage/img/' . $pic->photo) }}" alt="" class="img-fluid border-dark"></div>
          @endforeach
        </div>
        @if ($facility->facilities->count() > 0)
          <p class="m-0">Fasilitas : </p>
          <ul>
            @foreach ($facility->facilities as $item)
              <li>{{ $item->facility }}</li>  
            @endforeach
          </ul>
        @endif
        <p class="text-justify m-0 mt-2">{{ $facility->description }}</p>
      @endif
    </div>
    @if ($facility->site_pictures->count() === 1)
      <img src="{{ asset('/storage/img/' . $facility->site_pictures->first()->photo) }}" alt="" class="card-img rounded-0">
      <div class="card-body">
        @if ($facility->facilities->count() > 0)
          <p class="m-0">Fasilitas : </p>
          <ul>
            @foreach ($facility->facilities as $item)
              <li>{{ $item->facility }}</li>  
            @endforeach
          </ul>
        @endif
        <p class="text-justify m-0">{{ $facility->description }}</p>
      </div>
    @endif
  </div>
  <hr>
@endsection