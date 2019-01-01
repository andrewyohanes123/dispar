@extends('layouts.dashboard')

@section('title', 'Tambah Objek Wisata')

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center">
      <a href="{{ route('tempat-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-fw"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-map-marker fa-fw"></i>&nbsp;Tempat wisata</h4>
    </div>
    <hr>
    <div class="card">
      <div class="card-body">
        <div id="travel-form"></div>
        {{-- <div class="row">
          <div class="col-md-6">
            <form action="{{ route('tempat-wisata.store') }}" enctype="multipart/form-data" method="post">
              <label for="" class="control-label mb-1 mt-1">Nama tempat wisata</label>
              <input type="text" name="name" placeholder="Nama tempat wisata" class="form-control">
              <label for="" class="control-label mb-1 mt-1">Alamat tempat wisata</label>
              <input type="text" name="address" placeholder="Alamat tempat wisata" class="form-control">
              <label for="" class="control-label mb-1 mt-1">Tipe wisata</label>
              <select name="travel_type_id" id="" class="form-control">
                <option value="">Pilih tipe wisata</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
              </select>
              <label for="" class="control-label mb-1 mt-1">Gambar tempat wisata</label>
              <input type="file" name="photo[]" multiple="true" accept="image/*" class="form-control" id="">
              <label for="" class="control-label mb-1 mt-1">Deskripsi tempat wisata</label>
              <textarea name="description" rows="5" placeholder="Deskripsi" class="form-control"></textarea>
              @csrf
              <hr>
              <button type="submit" class="btn btn-outline-success btn-sm">Buat</button>
            </form>
          </div>
          <div class="col-md-6">
          </div>
        </div> --}}
      </div>
    </div>
    <hr>
@endsection