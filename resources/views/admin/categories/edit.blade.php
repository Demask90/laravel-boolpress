@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Modifica post</h1>
            <form action="{{route('admin.categories.update', $categories->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Titolo:</label>
                    <input type="text" name="name" class="form-control" @error('name') is-valid @enderror value="{{old('name', $categories->name)}} ">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Contenuto</label>
                    <textarea name="content" id="content" class="form-control" @error('content') is-valid @enderror>{!! old('content', $categories->content) !!}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Modify Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection