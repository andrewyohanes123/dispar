@extends('layouts.dashboard')
@section('title', 'Kalender Kegiatan')
@section('content')
  <div class="d-flex flex-row justify-content-between align-items-center">
    <h4 class="m-0"><i class="fa fa-calendar fa-lg"></i>&nbsp;Event</h4>
    <a href="{{ route('kalender-kegiatan.create') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Tambah Kegiatan</a>
  </div>
  <hr>
  @if ($events->count() === 0)
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="text-center mb-0">Belum ada kegiatan</h4>
      </div>
    </div>
  @else
    <div class="card-columns">
      @foreach ($events as $event)
          <div class="card border-0 shadow-sm">
            <svg class="card-img-top" height="200" width="100%">
              <rect fill="#ff6b6b" width="100%" height="100%"></rect>
              <text alignment-baseline="middle" font-size="30" text-anchor="middle" x="50%" y="50%" fill="#ffffff">{{ \Carbon\Carbon::parse($event->event_from)->format('d M') }} - {{ \Carbon\Carbon::parse($event->event_to)->format('d M') }}</text>
            </svg>
            <div class="card-body">
              <h4 class="m-0">{{ $event->name }}</h4>
              <p class="text-muted small">{{ str_limit($event->event_location->location, 50) }}</p>
              {{-- <div class="btn-group w-100"> --}}
                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye fa-lg"></i></a>
                <a href="{{ route('kalender-kegiatan.edit', [ 'id' => $event->id ]) }}" class="btn btn-warning text-dark btn-sm"><i class="fa fa-edit fa-lg"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-remove fa-lg"></i></a>
              {{-- </div> --}}
            </div>
            {{-- <img src="{{ asset('/storage/img/' . $event->event_pictures->first()->picture) }}" alt="" class="card-img rounded-0">
            <div class="card-footer" >
            </div> --}}
          </div>
      @endforeach
    </div>
  @endif
  <hr>
@endsection