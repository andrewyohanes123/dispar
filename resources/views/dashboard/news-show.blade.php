@extends('layouts.dashboard')
@section('title', $news->title)

@section('content')
    <div class="container-fluid mb-3">
      <div class="d-flex flex-row justify-content-between align-items-center">        
        <a href="{{ route('berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-md"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-edit fa-fw"></i>&nbsp;Preview berita</h4>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-8">
          {{--  --}}
          <div class="card">
            <div class="card-body pb-2">
                <a href="{{ route('berita.show', ['id' => $news->id]) }}" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-edit fa-lg"></i></a>
              <h3 class="m-0">{{ $news->title }}</h3>
              <p class="m-0 small text-muted">Di post oleh {{ $news->user->name }} pada tanggal {{ $news->created_at->format('D m Y') }}</p>
            </div>
            <img src="{{ asset('storage/img/' . $news->hero_img ) }}" title="{{ $news->title }}" alt="" class="card-img">
            <div class="card-body text-justify">
              <p>{!! $news->content !!}</p>
            </div>
          </div>
          {{--  --}}
        </div>
        {{--  --}}
        <div class="col-md-4">
          <div class="card">
            <div class="list-group list-group-flush">
              @foreach ($collection as $item)
                <a href="{{ route('berita.show', ['id' => $item->id]) }}" class="list-group-item list-group-action">
                  <h5 class="m-0">{{ $item->title }}</h5>
                  <p class="m-0 text-muted small">Di post oleh {{ $item->user->name }}</p>
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection