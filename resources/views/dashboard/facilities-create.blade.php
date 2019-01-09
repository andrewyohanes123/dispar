@extends('layouts.dashboard')
@section('title', 'Tambah Fasilitas Wisata')

@section('content')
  <div class="d-flex flex-row justify-content-between align-items-center">
    <a href="{{ route('fasilitas-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-fw"></i>&nbsp;Kembali</a>
    <h4 class="m-0"><i class="fa fa-building-o fa-lg"></i>&nbsp;Fasilitas Wisata</h4>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('fasilitas-wisata.store') }}" enctype="multipart/form-data" method="POST" class="form-group">
            <label for="" class="control-label mb-1 mt-1">Nama fasilitas wisata</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama tempat wisata" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
            @if ($errors->has('name'))
              <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('name') }}</span>
            @endif
            <label for="" class="control-label mb-1 mt-1">Alamat fasilitas wisata</label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="Alamat tempat wisata" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">
            @if ($errors->has('address'))
              <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('address') }}</span>
            @endif
            <label for="" class="control-label mb-1 mt-1">Tipe fasilitas</label>
            <select name="site_type_id" id="" class="form-control {{ $errors->has('site_type_id') ? 'is-invalid' : '' }}">
                <option value="">Pilih tipe fasilitas</option>
                @foreach ($types as $type)
                <option {{ old('site_type_id') === $type->id ? 'selected="true"' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('site_type_id'))
              <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('site_type_id') }}</span>
            @endif
            <label for="" class="control-label mb-1 mt-1">Gambar fasilitas wisata</label>
            <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="">
            @if ($errors->has('photo'))
              <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('photo') }}</span>
            @endif
            <label for="" class="mt-2">Fasilitas | <button class="btn btn-outline-dark btn-sm" id="tambah-fasilitas">Tambah fasilitas</button></label>
            <input type="text" name="facility[]" placeholder="Contoh : WiFi" class="form-control">
            <div id="facility">
              
            </div>
            <label for="" class="control-label mb-1 mt-1">Deskripsi fasilitas wisata</label>
            <textarea name="description" rows="5" placeholder="Deskripsi" class="form-control">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
              <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('description') }}</span>
            @endif
            <input type="hidden" value="{{ old('latitude') }}" name="latitude">
            <input type="hidden" value="{{ old('longitude') }}" name="longitude">
            @csrf
            <hr>
            <button type="submit" class="btn btn-outline-success btn-sm">Buat</button>
          </form>
        </div>
        <div class="col-md-6">
          <div style="height : 60vh; width : 100%;" id="facilities-map"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('facilities-map'), {
        center: {lat: 1.4692688, lng : 124.8391552},
        zoom: 14
      });
      var marker = new google.maps.Marker({
        position : {lat: 1.4692688, lng : 124.8391552},
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY&callback=initMap"
async defer></script>
@endsection