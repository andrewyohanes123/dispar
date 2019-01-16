@extends('layouts.home')
@section('title', 'Gallery')

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center">
      <h4 class="m-0"><i class="fa fa-picture-o fa-lg"></i>&nbsp;Gallery</h4>
    </div>
    <hr>
    <div id="galleries"></div>
    {{-- <div class="card-columns">
      @foreach ($picts as $pict)
        <div class="card">
          <img src="{{ asset('storage/img/' . $pict->photo ) }}" class="card-img" title="{{ $pict->site->name }}">
        </div>
      @endforeach
    </div> --}}
    <hr>
    {{-- <div class="d-flex flex-row justify-content-center">
      {!! $picts->links() !!}
    </div> --}}
@endsection