@extends('layout-folder.app-layout')

@section('content')
<div class="container">
    <h2>Détails de la catégorie</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID : {{ $category->id }}</h5>
            <p class="card-text"><strong>Nom :</strong> {{ $category->name }}</p>
            <p class="card-text"><strong>Créée le :</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Dernière mise à jour :</strong> {{ $category->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mt-3">Modifier</a>
    
    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
    </form>
</div>
@endsection
