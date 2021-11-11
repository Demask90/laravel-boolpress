@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Creazione nuovo tags</h2>
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Titolo:</label>
                        {{-- secondo metodo per visualizzare gli errori --}}
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Tags</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>

    
</style>