@extends('layout-folder.app-layout')

@section('content')
<div class="container mt-4">
    <h2>Événements auxquels vous êtes inscrit(e)</h2>

    @if ($events->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Catégorie</th>
                    <th>Max participants</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userevents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->category }}</td>
                        <td>{{ $event->max_participants }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $events->links() }}
        </div>
    @else
        <p>Vous n'êtes inscrit à aucun événement pour le moment.</p>
    @endif
</div>
@endsection
