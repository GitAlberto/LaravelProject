<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/events', [EventController::class, 'index'])->name('index');

Route::prefix('events')->group(function(){
    Route::get('getall', [EventController::class, 'index']); //Affichage de tous les evenements
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');// Affichage d'un événement spécifique
    Route::get('/events', [EventController::class, 'index'])->name('events.index');// Retour à la liste
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});


