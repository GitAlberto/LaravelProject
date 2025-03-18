@extends('layout-folder.app-layout')

@section('content')
<<<<<<< HEAD
<div class="container mt-4">
    <h2>Connexion</h2>

    {{-- ✅ Afficher les erreurs de connexion --}}
=======
<div class="container">
    <h2>Connexion</h2>

    <!-- Affichage des erreurs de validation -->
>>>>>>> 3094e2fb280ea48425fc26148eb9247f1bb7e03e
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<<<<<<< HEAD
    {{-- ✅ Afficher un message de succès (après inscription) --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf 
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
=======
    <!-- Formulaire de connexion -->
    <form action="{{ route('login.user') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

>>>>>>> 3094e2fb280ea48425fc26148eb9247f1bb7e03e
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
@endsection
<<<<<<< HEAD

=======
>>>>>>> 3094e2fb280ea48425fc26148eb9247f1bb7e03e
