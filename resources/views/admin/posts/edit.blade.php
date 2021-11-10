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
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value=""> Seleziona una Categoria </option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : null}}> {{$category->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p>Seleziona i Tag:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check form-check-inline">
                            @if ($errors->any())
                                {{-- se i tags già assegnati nella sezione modifica corrispondono al tag id attuale allora checked (devo definire nell' old che i tags verranno raccolti in un array--}}
                                <input {{in_array($tag->id, old('tags', [])) ? 'checked' : null }} value="{{ $tag->id }}" id="{{ 'tag'. $tag->id }}" type="checkbox" name="tags[]" class="form-check-input">
                                <label for="{{'tag'. $tag->id}}" class="form-check-label">{{ $tag->name}}</label>
                            @else
                                  {{-- se i tags id correlati al post contengono il tag attuale mettilo checked ( se il post ha già dei tags mostra quelli gia impostati nel post prima della modifica) --}}
                                  <input {{ $post->tags->contains($tag->id) ? 'checked' : null }} value="{{ $tag->id }}" id="{{ 'tag'. $tag->id }}" type="checkbox" name="tags[]" class="form-check-input">
                                  <label for="{{'tag'. $tag->id}}" class="form-check-label">{{ $tag->name}}</label>
                            @endif

                            
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Modify Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection