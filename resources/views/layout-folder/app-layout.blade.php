<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projet Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  <!--importation de chart.js pour les graphiques-->

    <style>
        /* Fixer le footer en bas */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .container {
       max-height: 80vh; /* Limite la hauteur du formulaire */
       overflow-y: auto; /* Active le scroll si besoin */
       padding-bottom: 20px; /* Ajoute un peu d'espace pour voir le bouton */
         }


    </style>
</head>
<body>




<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('events.index') }}">🏆 SportEvents</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('events.index') }}">Accueil</a>
                </li>

                <!-- Affichage pour les INVITÉS (non connectés) -->
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light me-2" href="{{ route('register.form') }}">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light me-2" href="{{ route('form.login') }}">Se connecter</a>
                    </li>
                @endguest

                <!-- Affichage pour les UTILISATEURS CONNECTÉS -->
                @auth
                    
                    <li class="nav-item dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('events.index') }}">📅 Mes événements</a></li>
                            <li><a class="dropdown-item" href="{{ route('myProfile.show', Auth::id()) }}">⚙️ Mon profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout.user') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">🚪 Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <!-- Affichage pour les ADMINISTRATEURS -->
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')
                        <li class="nav-item dropdown">
                            <a class="btn btn-danger dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ⚙️ Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">📊 Tableau de bord</a></li>
                                <li><a class="dropdown-item" href="{{ route('userprofiles.index') }}">👥 Gérer les utilisateurs</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.manage') }}">📆 Gérer les événements</a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}">📆 Gérer les catégories</a></li>
                            </ul>
                        </li>
                    @endif

                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- Juste pour vérifier le role -->
@if(Auth::check())
    <p>Rôle de l'utilisateur : {{ Auth::user()->role }}</p>
@else
    <p>Vous devez être connecté pour voir cette information.</p>
    <a href="{{ route('me.auth') }}">Se connecter</a>
@endif

@yield('content')

<!-- Footer -->
<footer class="bg-dark text-light text-center">
    <p class="mb-0">© 2025 SportEvents. Tous droits réservés.</p>
</footer>

<<<<<<< HEAD
<script>
    // Simuler l'état de connexion de l'utilisateur (remplace ceci avec du PHP/Laravel)
    let userLoggedIn = true;   // Mettre sur false pour voir la navbar des invités
    let isAdmin = true;        // Mettre sur false pour voir un simple utilisateur connecté

    if (userLoggedIn) {
        document.getElementById('guestNav').classList.add('d-none');
        document.getElementById('userNav').classList.remove('d-none');

        if (isAdmin) {
            document.getElementById('adminNav').classList.remove('d-none');
        }
    }
</script>





=======
>>>>>>> 3094e2fb280ea48425fc26148eb9247f1bb7e03e
</body>
</html>
