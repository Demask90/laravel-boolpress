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
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ $category['id'] }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['slug'] }}</td>

                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}"
                            class="btn btn-info">
                            Details
                        </a>
                        <a href=""
                            class="btn btn-warning">
                            Modify
                        </a>
                        {{-- delete post viene riconosciuto nella funzione deleteform in app.js visualizzando il promp di conferma cancellazione (ogni classe con delete-post richiamerà la funzione e farà visualizzare il messaggio di conferma) --}}
                        <form class="d-inline-block delete-category" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection