@extends('layouts.dashboard')
@section('title', $facility->name . ' | Fasilitas Wisata')
@section('content')
  {{-- {{ dd($facility->site_type->id) }} --}}
  <div class="d-flex flex-row justify-content-between align-items-center">
    <a href="{{ route('fasilitas-wisata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-fw"></i>&nbsp;Kembali</a>
    <h4 class="m-0"><i class="fa fa-building-o fa-lg"></i>&nbsp;Fasilitas Wisata</h4>
  </div>
  <hr>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
            <form action="{{ route('fasilitas-wisata.update', ['id' => $facility->id]) }}" enctype="multipart/form-data" method="POST" class="form-group">
              <label for="" class="control-label mb-1 mt-1">Nama fasilitas wisata</label>
              <input type="text" name="name" value="{{ $errors->has('name') ? old('name') : $facility->name }}" placeholder="Nama tempat wisata" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
              @if ($errors->has('name'))
                <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('name') }}</span>
              @endif
              <label for="" class="control-label mb-1 mt-1">Alamat fasilitas wisata</label>
              <input type="text" name="address" value="{{ $errors->has('address') ? old('address') : $facility->address }}" placeholder="Alamat tempat wisata" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">
              @if ($errors->has('address'))
                <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('address') }}</span>
              @endif
              <label for="" class="control-label mb-1 mt-1">Tipe fasilitas</label>
              <select name="site_type_id" id="" class="form-control {{ $errors->has('site_type_id') ? 'is-invalid' : '' }}">
                  <option value="">Pilih tipe fasilitas</option>
                  @foreach ($types as $type)
                  <option {{ $errors->has('site_type_id') ? ($type->id === old('site_type_id') ? 'selected' : '') : (($type->id === $facility->site_type->id) ? 'selected' : '') }} value="{{ $type->id }}">{{ $type->name }}</option>
                  @endforeach
              </select>
              @if ($errors->has('site_type_id'))
                <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('site_type_id') }}</span>
              @endif
              <label for="" class="control-label mb-1 mt-1">Deskripsi fasilitas wisata</label>
              <textarea name="description" rows="5" placeholder="Deskripsi" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $errors->has('description') ? old('description') : $facility->description }}</textarea>
              @if ($errors->has('description'))
                <span class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>&nbsp;{{ $errors->first('description') }}</span>
              @endif
              <input type="hidden" value="{{ $errors->has('latitude') ? old('latitude') : $facility->latitude }}" name="latitude">
              <input type="hidden" value="{{ $errors->has('longitude') ? old('longitude') : $facility->longitude }}" name="longitude">
              @csrf
              @method('PUT')
              <hr>
              <button type="submit" class="btn btn-outline-success btn-sm">Buat</button>
            </form>
        </div>
        <div class="col-md-6">
          <div style="height : 60vh; width : 100%;" id="facilities-map"></div>
          <div class="row mt-3 no-gutters">
            @foreach ($facility->site_pictures as $item)
              <div class="col-md-6 my-1">
                <img src="{{ asset('/storage/img/' . $item->photo) }}" alt="" class="img-fluid">
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    var map;
    var lat = document.querySelector('input[name="latitude"]').value;
    var lng = document.querySelector('input[name="longitude"]').value;
    lat = parseFloat(lat);
    lng = parseFloat(lng);
    function initMap() {
      map = new google.maps.Map(document.getElementById('facilities-map'), {
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
        });
      });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY&callback=initMap"
async defer></script>
@endsection