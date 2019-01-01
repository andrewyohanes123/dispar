@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="m-0">{{ $item->title }}</h4>
                <p class="text-muted small">Di post oleh {{ $item->user->name }}</p>
                <hr>
                <p class="m-0">{{ $item->content }}</p>
            </div>
        </div>
    </div>
@endsection