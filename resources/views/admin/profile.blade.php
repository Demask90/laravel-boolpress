@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">I tuoi dati</div>

                    <div class="card-body">
                        {{-- grazie al Auth posso avere accesso ai dati dell' attuale utente loggato  --}}
                        <div>Utente: {{ Auth::user()->name }}</div>
                        <div>Email: {{ Auth::user()->email }}</div>
                        {{-- se esiste api_token legato ad user --}}
                        @if (Auth::user()->api_token)
                            <div>{{ Auth::user()->api_token }}</div>
                        @else
                            <form action="{{ route('admin.generate-token') }}" method="post">
                                @csrf
                                @method('POST')

                                <button type="submit" class="btn btn-primary">Genera Api-Token</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection