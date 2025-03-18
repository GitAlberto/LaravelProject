<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar Événements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        <a class="navbar-brand" href="/">🏆 SportEvents</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/search">Rechercher</a>
                </li>
            </ul>

            <!-- Formulaire de recherche
            <form class="d-flex me-3">
                <input class="form-control me-2" type="search" placeholder="Rechercher un événement..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">🔍</button>
            </form> -->

            <!-- Utilisateur non connecté -->
            <div id="guestNav">
                <a class="btn btn-outline-light me-2" href="/login">Se connecter</a>
                <a class="btn btn-primary" href="/register">S'inscrire</a>
            </div>

            <!-- Utilisateur connecté
            <div id="userNav" class="d-none">
                <a class="btn btn-success me-3" href="/events/create">➕ Créer un événement</a>
                
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        👤 Mon Compte
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/my-events">📅 Mes événements</a></li>
                        <li><a class="dropdown-item" href="/profile">⚙️ Mon profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/logout">🚪 Se déconnecter</a></li>
                    </ul>
                </div>
            </div> -->

            <!-- Administrateur
            <div id="adminNav" class="d-none">
                <div class="dropdown ms-3">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        ⚙️ Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/admin">📊 Tableau de bord</a></li>
                        <li><a class="dropdown-item" href="/admin/users">👥 Gérer les utilisateurs</a></li>
                        <li><a class="dropdown-item" href="/admin/events">📆 Gérer les événements</a></li>
                    </ul>
                </div>
            </div> -->

        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="bg-dark text-light text-center">
    <p class="mb-0">© 2025 SportEvents. Tous droits réservés.</p>
</footer>

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





</body>
</html>
