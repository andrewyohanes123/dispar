@extends('layouts.dashboard')

@section('title', 'Berita')

@section('content')
  <div class="container-fluid">
    {{-- <div class="card"> --}}
      <div class="d-flex flex-row justify-content-between align-items-center">
        @if (!request()->q)
          <h4 class="m-0"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;Berita | <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o fa-lg"></i>&nbsp;Tambah berita</a></h4>
        @else
          <a href="{{ route('berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-md"></i>&nbsp;Kembali</a>
        @endif
        <form action="" method="get" class="d-inline form-group">
          <div class="input-group input-group-sm">
            <input type="text" name="q" value="{{ request()->q }}" placeholder="Cari berita" class="form-control">
            <div class="input-group-append">
              <button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button>
            </div>
          </div>
        </form>
      </div>
      {{-- </div> --}}
    @if (request()->q)
      <div class="alert alert-info mt-2 mb-1">
        <i class="fa fa-search fa-lg"></i>&nbsp;Hasil pencarian dari '{{ request()->q }}' - {{ $news->total() }} berita
      </div>
    @else
      <hr>
    @endif
    <div class="card-columns">
      @foreach ($news as $item)
          <div class="card mt-2 mb-1">
            <img src="{{ asset('storage/img/' . $item->hero_img) }}" alt="" class="card-img-top">
            <div class="card-body">
              <h4 class="m-0">{{ $item->title }}</h4>
              <p class="small text-muted">Di post oleh {{ $item->user->name }} pada {{ $item->created_at->format('d M Y') }}</p>
              <p id="news{{ $item->id }}" class="m-0 text-truncate text-justify">{{ $item->content }}</p>
              <hr>
              <a href="{{ route('berita.edit', ['id' => $item->id]) }}" title="Edit {{ $item->title }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg"></i></a>
              <a href="{{ route('berita.destroy', ['id' => $item->id]) }}" title="Hapus {{ $item->title }}" data-id="{{ $item->id }}" class="btn btn-danger btn-sm hapus-berita"><i class="fa fa-remove fa-lg"></i></a>
              <a href="{{ route('berita.show', ['id' => $item->id]) }}" title="Preview {{ $item->title }}" class="btn btn-primary btn-sm"><i class="fa fa-eye fa-lg"></i></a>
              <form id="delete-form{{ $item->id }}" action="{{ route('berita.destroy', ['id' => $item->id]) }}" method="post">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
      @endforeach
    </div>
    <hr>
    <div class="d-flex flex-row justify-content-between align-items-center">
      {{ $news->appends(request()->input())->links() }}
      <code class="d-block">
        {{ $news->currentPage() }} / {{ $news->lastPage() }}
      </code>
    </div>
  </div>  
@endsection