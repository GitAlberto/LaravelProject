<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

// 🔹 Routes pour l'authentification (avec middleware 'web')
Route::middleware(['web'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// 🔹 Page d'accueil
Route::get('/', function () {
    return redirect()->route('events.index');
});

// 🔹 Routes protégées pour la gestion des événements
Route::prefix('events')->middleware(['auth'])->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index'); // Liste des événements
    Route::get('/create', [EventController::class, 'create'])->name('events.create'); // Formulaire de création
    Route::post('/', [EventController::class, 'store'])->name('events.store'); // Enregistrement d'un événement
    Route::get('/{id}', [EventController::class, 'show'])->name('events.show'); // Affichage d'un événement spécifique
});

