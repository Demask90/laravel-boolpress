@extends('layouts.dashboard');

@section('content')
    <div class="container ">
        <div class="row">
            <div class="card m-0 p-0 col-12">
                
                <h1 class="card-header bg-secondary text-white"> {{$post->title}} </h1>
                <div class="card-text m-4">
                    <h3>Contenuto:</h3>
                    <p>{{$post->content}}</p>
                </div>
                <div class="card-text mx-4">   
                    <h6>Visualizzazione del post numero: {{ $post->id }}</h6>
                    <h6>Categoria di appertenza: <a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a></h6>
                    <h6>Tags associati al post:</h6>
                    @foreach ($post->tags as $tag)
                            <div><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a></div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
@endsection