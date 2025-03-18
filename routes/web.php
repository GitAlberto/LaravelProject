<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserEventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/me', [AuthController::class, 'me'])->name('me.auth');

// Routes pour les événements avec middleware
Route::prefix('events')->group(function(){
    Route::get('getall', [EventController::class, 'index']); // Affichage de tous les événements
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show'); // Affichage d'un événement spécifique
    Route::get('/events', [EventController::class, 'index'])->name('events.index'); // Retour à la liste
    Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
    Route::get('/search', [EventController::class, 'search'])->name('events.search');

    // Ces routes nécessitent une connexion (middleware 'auth')
    Route::middleware('auth')->group(function () {
        
        Route::get('/my-events', [UserEventController::class, 'store'])->name('events.subscribe');
        Route::get('/my-events/getall', [UserEventController::class, 'showUserEvents'])->name('myevents.list');
       
    });

    // Routes accessibles uniquement par admin ou super admin
    Route::middleware(['auth', 'role:admin'])->group(function () {

        //routes pour gérer les events (uniquement pour les admins)
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/destroy/{id}', [EventController::class, 'destroy'])->name('events.destroy');

        //routes pour gérer les events
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::get('/events-manage', [EventController::class, 'eventsManage'])->name('events.manage');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');

        //route pour le dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //routes pour gérer les categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); //accéder à la liste
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');//accès à la page de création
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');//pour enregistrer les catégories
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');// les détails d'une ctégorie
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');// modifier une ctégorie
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update'); //mettre à jour les modifications
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // supprimer une ctégorie


    });

    });

// Routes pour l'authentification (connexion et inscription)
Route::prefix('auth')->group(function(){
    Route::get('form', [AuthController::class, 'showRegisterForm'])->name('register.form'); // Affichage d'inscription
    Route::post('register', [AuthController::class, 'register'])->name('register.profile'); // Enregistrement dans la base de données
    Route::get('form-login', [AuthController::class, 'showlogin'])->name('form.login'); // Afficher la page de connexion
    Route::post('login', [AuthController::class, 'login'])->name('login.user'); // Connexion au site
    Route::post('logout', [AuthController::class, 'logout'])->name('logout.user'); // Déconnexion au site
});

// Routes pour les profils utilisateurs
Route::prefix('profile')->group(function(){
    Route::middleware('auth')->group(function () {
        Route::get('getall', [ProfileController::class, 'index'])->name('userprofiles.index'); // Affichage de tous les profils
        Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('userprofiles.show'); // Affichage d'un profil spécifique
        Route::get('/my-profile', [ProfileController::class, 'MyProfile'])->name('myProfile.show'); // Affichage d'un profil spécifique
    });
});
