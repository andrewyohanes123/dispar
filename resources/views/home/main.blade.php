@extends('layouts.home')

@section('title', 'Dinas Pariwisata Pemerintah Kota Manado')

@section('style')
    <style>
        #map {
            width : 100%;
            height : 60vh;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
@endsection

@section('content')
    <div class="card o-hidden p-relative">
        {{-- <div class="card-header">
            <p class="m-0 text-muted">Tempat Wisata</p>
        </div> --}}
        <div id="homemap"></div>
        {{-- <div class="card-body">
        </div> --}}
    </div>
    @include('home.menu')
    <div class="row mt-3 mb-3">
        <div class="col-md-8">
            @include('home.note')
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-0">Berita Terkini</h4>
                </div>
                <div class="list-group list-group-flush">
                    @foreach ($news as $item)
                        <a href="{{ route('root.show-news', ['slug' => $item->slug, 'year' => $item->created_at->format('Y'), 'month' => $item->created_at->format('m')]) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 blockquote  ">{{ $item->title }}</h5>
                            </div>
                            <p class="mb-1 text-truncate">{{ $item->content }}</p>
                            <small class="text-muted">{{ $item->created_at->formatLocalized('%A, %d %B %Y') }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script>
            // Initialize and add the map
            function initMap() {
              // The location of Uluru
              var manado = {lat: 1.4692688, lng : 124.8391552};
              // The map, centered at Uluru
              var map = new google.maps.Map(
                  document.getElementById('map'), 
                  {
                    zoom: 14, 
                    center: manado,
                    zoomControl: true,
                    mapTypeControl: false,
                    scaleControl: true,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false
                });              
            //   var marker = new google.maps.Marker({position: uluru, map: map});
            }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY&callback=initMap&language=id"></script> --}}
@endsection