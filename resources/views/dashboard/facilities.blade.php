@extends('layouts.dashboard')
@section('title', 'Fasilitas Wisata')

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center">
      <h4 class="m-0"><i class="fa fa-building fa-fw"></i>&nbsp;Fasilitas Wisata | <a href="{{ route('fasilitas-wisata.create') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Tambah fasilitas</a></h4>
      <form action="" method="get">
        <div class="input-group">
          <input name="q" value="{{ request()->q }}" type="text" placeholder="Cari tempat wisata" class="form-control">
          <div class="input-group-append"><button class="btn btn-dark"><i class="fa fa-search fa-lg"></i></button></div>
        </div>
      </form>
    </div>
    <hr>
    @if ($facilities->count() > 0)
      <div class="card-columns">
        @foreach ($facilities as $facility)
            <div class="card border-0 shadow-sm">
              <img class="card-img-top" src="{{ asset('storage/img/' . $facility->site_pictures->first()->photo) }}" alt="">
              <div class="card-body ">
                <h4 class="m-0">{{ $facility->name }}</h4>
                <p class="m-0 small text-muted">{{ $facility->site_type->name }} - {{ $facility->address }}</p>
                <p>{{ str_limit($facility->description, 80) }}</p>
                <hr>
                <a href="{{ route('fasilitas-wisata.edit', ['id' => $facility->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit {{ $facility->title }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg"></i></a>
                <a href="{{ route('fasilitas-wisata.destroy', ['id' => $facility->id]) }}" title="Hapus {{ $facility->title }}" data-id="{{ $facility->id }}" class="btn btn-danger btn-sm hapus-berita"><i class="fa fa-remove fa-lg"></i></a>
                <a href="{{ route('fasilitas-wisata.show', ['id' => $facility->id]) }}" title="Preview {{ $facility->title }}" class="btn btn-primary btn-sm"><i class="fa fa-eye fa-lg"></i></a>
              </div>
            </div>
        @endforeach
      </div>
    @else
      <div class="card mb-2 mt-2">
        <div class="card-body text-center">
          <h4 class="m-0">Belum ada fasilitas wisata</h4>
          <a href="{{ route('fasilitas-wisata.create') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Tambah fasilitas</a>
        </div>
      </div>
    @endif
    <hr>
    {!! $facilities->links() !!}
@endsection