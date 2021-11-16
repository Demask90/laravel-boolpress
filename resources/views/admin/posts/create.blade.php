@extends('layouts.dashboard')

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
                <div>
                    <h5>Crea un nuovo tag:</h5>
                    <form method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <button type="submit" formaction="{{ route('admin.tags.store') }}" class="btn btn-success">Crea Tag</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        {{-- secondo metodo per visualizzare gli errori --}}
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{!!old('content')!!}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value=""> Seleziona una Categoria </option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : null}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Tag esistenti:</p>
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                {{-- come definito nel file edit devo salvarmi le modifiche fatte ai tags,  in caso di errore nella creazione di un post mi tiene salvati i tags che ho selezionato--}}
                                <input value="{{$tag->id}}" id="{{'tag'. $tag->id}}" type="checkbox" name="tags[]" class="form-check-input" {{in_array($tag->id, old('tags', [])) ? 'checked' : null }}>
                                <label for="{{'tag'. $tag->id}}" class="form-check-label">{{ $tag->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>

    
</style>