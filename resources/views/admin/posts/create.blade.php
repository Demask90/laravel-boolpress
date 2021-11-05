@extends('layouts.dashboard');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Creazione nuovo post</h2>

                {{-- primo metodo per visualizzare gli errori --}}
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <form action="{{ route('admin.post.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        {{-- secondo metodo per visualizzare gli errori --}}
                        <input type="text" name="title" class="form-control @error('title') is-valid @enderror" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Content</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-valid @enderror">{!!old('content')!!}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection