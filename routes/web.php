<?php

use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/events', [EventController::class, 'index'])->name('index');

Route::prefix('events')->group(function(){
    Route::get('getall', [EventController::class, 'index']); //Affichage de tous les evenements
    Route::get('getallmy', [EventController::class, 'index']); //Affichage de tous les evenements auquels je me suis incrit
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');// Affichage d'un événement spécifique
    Route::get('/events', [EventController::class, 'index'])->name('events.index');// Retour à la liste
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    Route::get('/my-events', [EventController::class, 'create'])->name('events.mine');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/destroy/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});



Route::prefix('profile')->group(function(){
    Route::get('getall', [ProfileController::class, 'index'])->name('userprofiles.index');//Affichage de tous les profiles
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('userprofiles.show');//Affichage d'un profile spécifique
});