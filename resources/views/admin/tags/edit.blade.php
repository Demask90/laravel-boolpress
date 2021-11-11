@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Modifica Tags</h1>
            <form action="{{route('admin.tags.update', $tags->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Titolo:</label>
                    <input type="text" name="name" class="form-control" @error('name') is-valid @enderror value="{{old('name', $tags->name)}} ">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Modify Tags</button>
                </div>
            </form>
        </div>
    </div>
@endsection