@extends('layout-folder.app-layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Créer un événement</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf <!-- Protection contre les attaques CSRF -->

                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'événement</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Lieu -->
                <div class="mb-3">
                    <label for="location" class="form-label">Lieu</label>
                    <input type="text" name="location" id="location" class="form-control" required>
                </div>

                <!-- Date -->
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select name="category_id" id="category" class="form-control" required>
                        <option value="">-- Sélectionner une catégorie --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Nombre max de participants -->
                <div class="mb-3">
                    <label for="max_participants" class="form-label">Nombre maximum de participants</label>
                    <input type="number" name="max_participants" id="max_participants" class="form-control" required>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Créer l'événement</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection
