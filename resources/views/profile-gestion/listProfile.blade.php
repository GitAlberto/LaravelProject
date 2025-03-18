@extends('layout-folder.app-layout')

@section('content')
<div class="container mt-5">
        <h1>Liste des profils</h1>

        @if($profiles->isEmpty())
            <p>Aucun profil disponible.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Code Postal</th>
                        <th>Ville</th>
                        <th>Âge</th>
                        <th>Sexe</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $profile->id }}</td>
                            <td>{{ $profile->fist_name }}</td>
                            <td>{{ $profile->user->name }}</td>
                            <td>{{ $profile->postale_code }}</td>
                            <td>{{ $profile->city }}</td>
                            <td>{{ $profile->age }}</td>
                            <td>{{ ucfirst($profile->sex) }}</td> <!-- Affiche 'Male' ou 'Female' -->
                            <td>{{ $profile->user->email }}</td>
                            <td>
                                <a href="{{ route('userprofiles.show', $profile->id) }}" class="btn btn-info">Voir</a>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

<!-- Pagination -->
<div>
    {{ $profiles->links() }} <!-- Liens de pagination -->
</div>

@endsection