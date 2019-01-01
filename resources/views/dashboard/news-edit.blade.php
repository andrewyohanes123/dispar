@extends('layouts.dashboard')
@section('title', 'Edit ' . $news->title)

@section('content')
    <div class="container-fluid mb-3">
      <div class="d-flex flex-row justify-content-between align-items-center">
        <a href="{{ route('berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-md"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-edit fa-fw"></i>&nbsp;Edit Berita</h4>
      </div>
      <hr>
      <div class="card">
        <div class="card-body">
          <form action="" class="form-group">
            <label for="" class="control-label mt-1 mb-1">Judul berita</label>
            <input type="text" placeholder="Judul Berita" value="{{ $news->title }}" class="form-control {{ ($errors->hasError('title') ? 'is-invalid' : '') }}">
            <label for="" class="control-label mt-1 mb-1">Isi berita</label>
            <textarea name="content" id="" rows="5" class="form-control {{ ($errors->hasError('content') ? 'is-invalid' : '') }}">{{ $news->content }}</textarea>
            <label for="" class="control-label mt-1 mb-1">Upload gambar cover</label>
            <input type="file" name="" id="" class="form-control">
            <label for="" class="control-label mt-1 mb-1">Gambar cover</label>
            <img src="{{ asset('storage/img/' . $news->hero_img) }}" class="img-thumbnail w-50 d-block" alt="{{ $news->title }}" title="{{ $news->title }}">
          </form>
        </div>
      </div>
    </div>
@endsection