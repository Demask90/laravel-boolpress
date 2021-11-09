@extends('layouts.dashboard');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <h2>{{$post->title}}</h2>
                <p>{{$post->content}}</p>
                <h5>Lo slug è {{ $post->slug }}</h5>
                <h5>Categoria di appertenza: <a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a></h5>
            </div>
        </div>
    </div>
@endsection