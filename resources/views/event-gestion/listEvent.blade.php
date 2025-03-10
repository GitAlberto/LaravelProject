@extends('layout-folder.app-layout')

@section('content')
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
<div>
    <a href="{{ route('events.create') }}" class="btn btn-success btn-sm">créer un evement</a>
</div>
<br>
<!-- Pagination -->
<div>
    {{ $events->links() }} <!-- Liens de pagination -->
</div>

@endsection