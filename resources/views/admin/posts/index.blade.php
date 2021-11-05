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
            @foreach ($posts as $post)
                <tr>
                    <td scope="row">{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['slug'] }}</td>

                    <td>
                        <a href="{{ route('admin.posts.show', $post->id) }}"
                            class="btn btn-info">
                            Details
                        </a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                            class="btn btn-warning">
                            Modify
                        </a>
                        <form class="d-inline-block" method="POST" action="{{ route('admin.posts.destroy', $post->$id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirmDelete()" type="submit" class="btn btn-danger">Delete</button>
                        </form>ì
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection