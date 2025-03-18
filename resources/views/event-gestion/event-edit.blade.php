@extends('layout-folder.app-layout')

@section('content')
<div class="container">
    <h2>Modifier l'événement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lieu</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $event->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $event->category) }}" required>
        </div>

        <div class="mb-3">
            <label for="max_participants" class="form-label">Nombre max. de participants</label>
            <input type="number" name="max_participants" id="max_participants" class="form-control" value="{{ old('max_participants', $event->max_participants) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
