@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            @foreach ($items as $item)
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="m-0"><a href="{{ route('home.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a></h4>
                        <p class="text-muted small">{{ $item->user->name }}</p>
                        <p class="m-0">{{ $item->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
