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
            <p><strong>Catégorie :</strong> {{ $event->max_participants }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('events.index') }}" class="btn btn-primary">Retour à la liste</a>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('events.index') }}" class="btn btn-success">S'inscrire</a>
        </div>
    </div>
</div>

@endsection