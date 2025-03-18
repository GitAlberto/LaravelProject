@extends('layout-folder.app-layout')

@section('content')
    @include('event-gestion.listEvent', ['categories' => $categories])
    @include('event-gestion.listEvent', ['events' => $events])
<div class="container">
    <h2>Liste des catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
</div>
@endsection
