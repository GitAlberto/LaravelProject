@extends('layout-folder.app-layout')

@section('content')
<div class="container mt-4">
    <h2>Inscription</h2>

    {{-- ✅ Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf 

        {{-- 🔹 Nom et Prénom --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="fist_name" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="fist_name" name="fist_name" required>
        </div>

        {{-- 🔹 Code Postale et Ville --}}
        <div class="mb-3">
            <label for="postale_code" class="form-label">Code Postale</label>
            <input type="text" class="form-control" id="postale_code" name="postale_code" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>

        {{-- 🔹 Âge et Sexe --}}
        <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="sex" class="form-label">Sexe</label>
            <select class="form-control" id="sex" name="sex" required>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
        </div>

        {{-- 🔹 Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        {{-- 🔹 Mot de passe et Confirmation --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
@endsection
