@extends('layouts.dashboard')
@section('title', 'Post Berita')

@section('content')
<div class="d-flex flex-row justify-content-between align-items-center mt-2 mb-3">
  <a href="{{ route('berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-md"></i>&nbsp;Kembali</a>
  <h4 class="m-0"><i class="fa fa-plus-square-o fa-lg"></i>&nbsp;Post berita</h4>
</div>
<div class="card">
  <form action="{{ route('berita.store') }}" class="form-group m-0" enctype="multipart/form-data" method="POST">
    <div class="card-body">
      <label for="" class="control-label mt-1 mb-1">Judul berita</label>
      <input type="text" name="title" value="{{ old('title') }}" class="form-control {{ ($errors->has('title') ? 'is-invalid' : '') }}" placeholder="Judul berita">
      @if ($errors->has('title'))
          <span class="invalid-feedback">
            {{ $errors->first('title') }}
          </span>
      @endif
      <label for="" class="control-label mt-1 mb-1">Cover berita</label>
      <input type="file" name="hero_img" accept="img/*" id="" class="form-control {{ ($errors->has('hero_img') ? 'is-invalid' : '') }}">
      @if ($errors->has('hero_img'))
          <span class="invalid-feedback">
            {{ $errors->first('hero_img') }}
          </span>
      @endif
      <label for="" class="control-label mt-1 mb-1">Isi berita</label>
      <textarea name="content" class="form-control {{ ($errors->has('content') ? 'is-invalid' : '') }}" id="" placeholder="Isi berita" rows="5"></textarea>
      @if ($errors->has('content'))
          <span class="invalid-feedback">
            {{ $errors->first('content') }}
          </span>
      @endif
      @csrf
      <hr>
      <button type="submit" class="btn btn-success btn-sm">Post</button>
    </div>
  </form>
</div>
{{-- @if ($errors) --}}
@foreach ($errors as $error)
    <div class="alert alert-danger">
      {{ $error }}
    </div>
@endforeach
{{-- @endif --}}
@endsection