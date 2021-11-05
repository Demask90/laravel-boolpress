@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Modifica post</h1>
            <form action="{{route('admin.posts.update',$post->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" class="form-control" @error('title') is-valid @enderror value="{{old('title', $post->title)}} ">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Contenuto</label>
                    <textarea name="content" id="content" class="form-control" @error('content') is-valid @enderror>{!! old('content', $post->content) !!}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Modify Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection