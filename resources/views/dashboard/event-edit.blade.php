@extends('layouts.dashboard')
@section('title', 'Edit ' . $event->name . ' | ' . config('app.name'))

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
        <a href="{{ route('kalender-kegiatan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
        <h4 class="m-0"><i class="fa fa-calendar fa-lg"></i>&nbsp;Event</h4>
    </div>
    <div class="card mb-2">
      <div class="card-body">
        <form action="{{ route('kalender-kegiatan.update', ['id' => $event->id]) }}" method="post">
          <div class="row">
            <div class="col-md-6">
              <label for="" class="mb-1 control-label">Nama event</label>
              <input type="text" placeholder="Nama event" name="name" value="{{ $errors->has('name') ? old('name') : $event->name }}" class="form-control">
              <label for="" class="mb-1 control-label">Tanggal event</label>
              <input type="text" name="date" placeholder="Tanggal event" value="{{ $errors->has('date') ? old('date') : $event->event_from . " to " . $event->event_to }}" class="form-control">
              <label for="">Deskripsi event</label>
              <textarea name="description" class="form-control" rows="5">{{ $errors->has('description') ? old('description') : $event->description }}</textarea>
              @csrf
              @method('PUT')
              <hr>
              <button type="submit" class="btn btn-outline-success"><i class="fa fa-save fa-fw"></i>&nbsp;Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection