@extends('layouts.dashboard')
@section('title', $travel->name . ' | ' . config('app.name'))

@section('meta')
  <meta name="travel-id" content="{{ $travel->id }}">
@endsection

@section('content')
  <div class="d-flex flex-row justify-content-between align-items-center mb-3">
    <a href="{{ route('tempat-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
    <h4 class="m-0"><i class="fa fa-map-marker-o fa-lg"></i>&nbsp;Tempat Wisata</h4>
  </div>
  <div class="card mb-2">
    <div class="card-body">
      <div id="travel-edit"></div>
    </div>
  </div>
@endsection