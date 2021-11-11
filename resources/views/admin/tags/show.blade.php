@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="font-weight: bold">{{$tags->name}}</h1>
            </div>
            <div class="col-12 my-5">
                <h2 style="font-weight: bold">Lista dei post collegati a questo Tags:</h2>
                @forelse ($tags->posts as $post)
                    <li style="list-style: none"><a href="{{route('admin.posts.show', $post->id)}}">{{ $post->title}}</a></li>
                @empty
                    <p>nessun post collegato</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection