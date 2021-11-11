@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Lista Posts:</h1>
                <ul>
                    @foreach ($posts as $post)
                    <li class="card-header list-unstyled"><a href="{{route('posts.show', $post->slug)}}">{{$post->title}}</a></li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection