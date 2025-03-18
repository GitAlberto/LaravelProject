@extends('layout-folder.app-layout')

@section('content')

<form action="{{ route('events.search') }}" method="GET" class="d-flex align-items-end gap-2">
    <div class="form-group">
       <label for="category" class="form-label">Catégorie</label>
       <input type="text" name="category" id="category" class="form-control">
    </div>

    <div class="form-group">
        <label for="date">Date :</label>
        <input type="date" name="date" id="date" class="form-control">
    </div>

    <div class="form-group">
        <label for="location">Lieu :</label>
        <input type="text" name="location" id="location" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

@if ($events->isEmpty())
    <p>Aucun événement trouvé.</p>
@else

<div class="container mt-4">
    <h1 class="mb-4">Tous les événements</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->location }}</td>
                    <td>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@auth
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')
        <div>
            <a class="btn btn-success me-3" href="{{ route('events.create') }}">➕ Créer un événement</a>
        </div>
        <br>
        <div>
            <a class="btn btn-secondary me-3" href="{{ route('categories.create') }}">➕ Créer une Categorie</a>
        </div>
    @endif
@endauth

<br>
<!-- Pagination -->
<div>
    {{ $events->links() }} <!-- Liens de pagination -->
</div>

<div class="d-flex flex-column">
    <a href="{{ route('register') }}" class="btn btn-primary mb-2">S'inscrire</a>
    <a href="{{ route('login') }}" class="btn btn-secondary">Connexion</a>
</div>




@endsection