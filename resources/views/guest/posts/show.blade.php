@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{$post->title}}
                    </div>
                    <div class="card-body">
                        <div style="font-weight: bold">SLUG:</div>
                        <h5 class="card-title"> {{$post->slug}}</h5>
                        <div style="font-weight: bold">DESCRIZIONE:</div>
                        <p class="card-text">{{$post->content}}</p>

                        @if($post->cover)
                            <img src="{{ asset('storage/' .$post->cover) }}" alt="{{$post->title}}" class="img-fluid z-depth-1 rounded mb-4 my-cover">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection