@extends('layout-folder.app-layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Détails du Profil</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $profile->fist_name }}</h5>
            <p class="card-text"><strong>Nom :</strong> {{ $profile->user->name }}</p>
            <p class="card-text"><strong>Ville :</strong> {{ $profile->city }}</p>
            <p class="card-text"><strong>Code postal :</strong> {{ $profile->postale_code }}</p>
            <p class="card-text"><strong>Âge :</strong> {{ $profile->age }} ans</p>
            <p class="card-text"><strong>Sexe :</strong> {{ ucfirst($profile->sex) }}</p>
            <p class="card-text"><strong>Email :</strong> {{ $profile->user->email }}</p>
        </div>
    </div>

    <a href="{{ route('userprofiles.index') }}" class="btn btn-primary mt-3">Retour</a>
</div>
@endsection
