@extends('layouts.home')
@section('title', 'Visi dan Misi')

@section('content')
    <div class="card mb-3">
      <div class="card-body">
        <h4 class="m-0">Visi dan Misi</h4>
        <hr>
        @if ($point !== null)
          {!! $point->point !!}
        @endif
      </div>
    </div>
@endsection