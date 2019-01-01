@extends('layouts.home')
@section('title', $news->title)

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      <a href="{{ route('root.news') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;Berita</h4>
    </div>
    <div class="card mb-5">
      <div class="card-body">
        <h4 class="m-0">{{ $news->title }}</h4>
        <p class="m-0 small text-muted">Di post oleh {{ $news->user->name }} pada {{ $news->created_at->format('d M Y') }}</p>
      </div>
      <img src="{{ asset('storage/img/' . $news->hero_img) }}" title="{{ $news->title }}" alt="" class="card-img rounded-0">
      <div class="card-body">
        <p class="text-justify">{{ $news->content }}</p>
      </div>
    </div>
@endsection