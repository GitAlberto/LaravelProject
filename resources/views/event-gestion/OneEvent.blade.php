@extends("layout-folder.app-layout")

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>{{ $event->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Date :</strong> {{ $event->date }}</p>
            <p><strong>Lieu :</strong> {{ $event->location }}</p>
            <p><strong>Catégorie :</strong> {{ $event->category }}</p>
            <p><strong>Description :</strong></p>
            <p>{{ $event->description }}</p>
            <p><strong>Max participants :</strong> {{ $event->max_participants }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('events.index') }}" class="btn btn-primary">Retour à la liste</a>
        </div>

        @guest
            <div class="card-footer text-end">
                <a href="{{ route('register.form') }}" class="btn btn-success">S'inscrire</a>
            </div>
        @endguest


        <!-- Formulaire de suppression avec méthode DELETE -->
        @auth
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')

            <div class="card-footer text-end">
                    <a href="{{ route('event.subscribe') }}" class="btn btn-success">S'inscrire</a>
            </div>
                
            <div class="card-footer text-end">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Modifier</a>
            </div> 

            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>

            @endif
        @endauth

        @auth
            @if(Auth::user()->role == 'user')       
                <div class="card-footer text-end">
                    <a href="{{ route('events.subscribe') }}" class="btn btn-success">S'inscrire</a>
                </div>
            @endif
        @endauth
        
    </div>
</div>

@endsection
