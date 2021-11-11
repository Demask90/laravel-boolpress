@extends('layouts.dashboard')

@section('content')
    {{-- (redirecting with flashed session data) --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    {{-- (redirecting with flashed session data) --}}
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">slug</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td scope="row">{{ $tag['id'] }}</td>
                    <td>{{ $tag['name'] }}</td>
                    <td>{{ $tag['slug'] }}</td>

                    <td>
                        <a href="{{ route('admin.tags.show', $tag->id) }}"
                            class="btn btn-info">
                            Details
                        </a>
                        <a href="{{ route('admin.tags.edit', $tag->id) }}"
                            class="btn btn-warning">
                            Modify
                        </a>
                        {{-- delete post viene riconosciuto nella funzione deleteform in app.js visualizzando il promp di conferma cancellazione (ogni classe con delete-post richiamerà la funzione e farà visualizzare il messaggio di conferma) --}}
                        <form class="d-inline-block delete-post" method="POST" action="{{ route('admin.tags.destroy', $tag->id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirmDelete()" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection