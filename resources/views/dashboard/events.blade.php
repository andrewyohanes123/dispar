@extends('layouts.dashboard')
@section('title', 'Kalender Kegiatan')
@section('content')
  <div class="d-flex flex-row justify-content-between align-items-center">
    <h4 class="m-0"><i class="fa fa-calendar fa-lg"></i>&nbsp;Kalender Kegiatan</h4>
    <a href="{{ route('kalender-kegiatan.create') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Tambah Kegiatan</a>
  </div>
  <hr>
  @if ($events->count() === 0)
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="text-center mb-0">Belum ada kegiatan</h4>
      </div>
    </div>
  @endif
  <hr>
@endsection