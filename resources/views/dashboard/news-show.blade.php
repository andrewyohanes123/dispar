@extends('layouts.dashboard')
@section('title', $news->title)

@section('content')
    <div class="container-fluid mb-3">
      <div class="d-flex flex-row justify-content-between align-items-center">
        <a href="{{ route('berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-md"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-edit fa-fw"></i>&nbsp;Preview berita</h4>
      </div>
      <hr>
      <div class="card">
        <div class="card-body pb-2">
          <h3 class="m-0">{{ $news->title }}</h3>
          <p class="m-0 small text-muted">Di post oleh {{ $news->user->name }} pada tanggal {{ $news->created_at->format('D m Y') }}</p>
        </div>
        <img src="{{ asset('storage/img/' . $news->hero_img ) }}" title="{{ $news->title }}" alt="" class="card-img">
        <div class="card-body text-justify">
          <p>{{ $news->content }}</p>
        </div>
      </div>
    </div>
@endsection