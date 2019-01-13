@extends('layouts.home')
@section('title', $news->title)

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
      <a href="{{ route('root.news') }}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left fa-sm"></i>&nbsp;Kembali</a>
      <h4 class="m-0"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;Berita</h4>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card mb-5">
          <div class="card-body">
            <h4 class="m-0">{{ $news->title }}</h4>
            <p class="m-0 small text-muted">Di post oleh {{ $news->user->name }} pada {{ $news->created_at->format('d M Y') }}</p>
          </div>
          <img src="{{ asset('storage/img/' . $news->hero_img) }}" title="{{ $news->title }}" alt="" class="card-img rounded-0">
          <div class="card-body">
            <p class="text-justify">{{ $news->content }}</p>
          </div>
        </div>
      </div>
      {{--  --}}
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body">
            <form action="{{ route('root.news') }}" method="get" class="form-group m-0">
              <input type="text" name="q" class="form-control" placeholder="Cari berita">
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <p class="card-title m-0">Berita Terbaru</p>
          </div>
          <div class="list-group o-hidden list-group-flush">
            @foreach ($collection as $item)
              <a href="{{ route('root.show-news', ['slug' => $item->slug, 'year' => $item->created_at->format('Y'), 'month' => $item->created_at->format('m')]) }}" class="list-group-item anim list-group-action">
                <h5 class="m-0">{{ $item->title }}</h5>
                <p class="m-0 text-muted small">Di post oleh {{ $item->user->name }}</p>
              </a>
            @endforeach
          </div>
        </div>
      </div>
      {{--  --}}
    </div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('.anim').each(function(i, e) {
      $(e).css({'animation' : 'news-animation ' + (750+i) + 'ms forwards', 'animation-delay' : (1000 + (i*100)) + 'ms'})
      console.log(750+i, 500+ (10/i));
    })
    // console.log('rede')
  })
</script>
@endsection