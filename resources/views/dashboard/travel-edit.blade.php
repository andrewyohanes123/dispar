@extends('layouts.dashboard')
@section('title', $travel->name . ' | ' . config('app.name'))

@section('meta')
  <meta name="travel-id" content="{{ $travel->id }}">
@endsection

@section('content')
  <div class="card mb-2">
    <div class="card-body">
      <div id="travel-edit"></div>
    </div>
  </div>
@endsection