@extends('layouts.dashboard')
@section('title', 'Buat event baru')
@section('meta')
    <link rel="stylesheet" href="{{ asset('css/material_red.css') }}">
@endsection
@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      <a href="{{ route('kalender-kegiatan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-calendar fa-lg"></i>&nbsp;Buat Event</h4>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ route('kalender-kegiatan.store') }}" enctype="multipart/form-data" method="POST" class="form-group m-0">
        <div class="row">
          <div class="col-md-6">
              <label for="" class="control-label mb-1">Nama event</label>
              <input type="text" placeholder="Nama Event" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
              @if ($errors->has('name'))
                  <span class="invalid-feedback">{{ $errors->first('name') }}</span>
              @endif
              <label for="" class="control-label mb-1">Tanggal</label>
              <input type="text" value="{{ old('date') }}" placeholder="Nama Event" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}">
              @if ($errors->has('date'))
                  <span class="invalid-feedback">{{ $errors->first('date') }}</span>
              @endif
              <label for="" class="control-label mb-1">Deskripsi</label>
              <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="" placeholder="Deskripsi event" rows="5">{{ old('description') }}</textarea>
              @if ($errors->has('description'))
                  <span class="invalid-feedback">{{ $errors->first('description') }}</span>
              @endif
              <label for="" class="control-label mb-1">Gambar Event</label>
              <input type="file" name="picture" class="form-control">
              @if ($errors->has('picture'))
                  <span class="invalid-feedback">{{ $errors->first('picture') }}</span>
              @endif
              @csrf
              <hr>
              <button class="btn btn-outline-success btn-sm"><i class="fa fa-save fa-lg"></i>&nbsp;Buat</button>
            </div>
            <div class="col-md-6">
              <div style="height:60vh;width:100%;" id="event-map"></div>
              <input type="text" name="address" value="{{ old('address') }}" placeholder="Geser pin pada map untuk memilih lokasi" readonly class="form-control my-2 {{ $errors->has('address') ? 'is-invalid' : '' }}">
              @if ($errors->has('address'))
              <span class="invalid-feedback">{{ $errors->first('address') }}</span>
              @endif
              <input type="hidden" value="{{ old('latitude') }}" name="latitude">
              <input type="hidden" value="{{ old('longitude') }}" name="longitude">
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/flatpickr') }}"></script>
<script>
    var map;
    function initMap() {
      var lat = document.querySelector("input[name='latitude']").value
      var lng = document.querySelector("input[name='longitude']").value
      lat = (lat === '') ? 1.4692688 : lat;
      lng = (lng === '') ? 124.8391552 : lng;
      map = new google.maps.Map(document.getElementById('event-map'), {
        center: {lat: lat, lng : lng},
        zoom: 14
      });
      var marker = new google.maps.Marker({
        position : {lat: lat, lng : lng},
        map : map,
        draggable : true
      });
      var geocoder = new google.maps.Geocoder;

      google.maps.event.addListener(marker, 'dragend', function (event) {
        document.querySelector("input[name='latitude']").value = event.latLng.lat();
        document.querySelector("input[name='longitude']").value = event.latLng.lng();
        geocoder.geocode({ location : { lat : event.latLng.lat(), lng : event.latLng.lng() } }, function(results){
          document.querySelector("input[name='address']").value = results[0].formatted_address
        })
      });
    }
    // $(document).ready(function(){
    //   $('input[name="date"]').flatpickr({
    //     format : 'Y-m-d',
    //     mode : 'range'
    //   })
    // })
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY&callback=initMap"
async defer></script>
@endsection