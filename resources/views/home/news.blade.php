@extends('layouts.home')

@section('title', 'Berita')

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center">
      <h4 class="m-0"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;{{ __('Berita') }}</h4>
      <form action="" method="get">
        <div class="input-group">
          <input name="q" value="{{ request()->q }}" type="text" placeholder="Cari berita" class="form-control">
          <div class="input-group-append"><button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button></div>
        </div>
      </form>
    </div>
    <hr>
    <div class="card-columns">
      @foreach ($news as $item)
          <div class="card shadow-sm">
            <a href="{{ route('root.show-news', ['slug' => $item->slug, 'year' => $item->created_at->format('Y'), 'month' => $item->created_at->format('m')]) }}"><img src="{{ asset('storage/img/'. $item->hero_img) }}" class="card-img-top" alt=""></a>
            <div class="card-body">
              <h5 class="m-0"><a href="{{ route('root.show-news', ['slug' => $item->slug, 'year' => $item->created_at->format('Y'), 'month' => $item->created_at->format('m')]) }}">{{ $item->title }}</a></h5>
              <p class="m-0 small text-muted">Di post oleh {{ $item->user->name }} pada {{ $item->created_at->format('d M Y') }}</p>
              <p class="m-0 text-justify">{{ str_limit($item->content, 50) }}</p>
            </div>
          </div>
      @endforeach
    </div>
    <hr>
    <div class="d-flex flex-row justify-content-center align-items-center mb-5">
      {{ $news->appends(request()->q)->links() }}
    </div>
@endsection