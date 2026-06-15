<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('praticiens', \App\Http\Controllers\PraticienController::class);
    Route::resource('campaigns', \App\Http\Controllers\CampaignController::class);
    Route::resource('visites', \App\Http\Controllers\VisiteController::class);
});

require __DIR__.'/auth.php';

// Routes Messagerie Sécurisée
use App\Http\Controllers\MessageController;

Route::middleware(['auth'])->prefix('messages')->name('messages.')->group(function () {

    // Boîte de réception
    Route::get('/', [MessageController::class, 'inbox'])
        ->name('inbox');

    // Messages envoyés
    Route::get('/sent', [MessageController::class, 'sent'])
        ->name('sent');

    // Messages archivés
    Route::get('/archived', [MessageController::class, 'archived'])
        ->name('archived');

    // Formulaire nouveau message
    Route::get('/create', [MessageController::class, 'create'])
        ->name('create');

    // Télécharger une pièce jointe
    Route::get('/attachment/{id}/download', [MessageController::class, 'downloadAttachment'])
        ->name('attachment.download');

    // Envoyer un message
    Route::post('/', [MessageController::class, 'store'])
        ->name('store');

    // Lire un message
    Route::get('/{message}', [MessageController::class, 'show'])
        ->name('show');

    // Archiver un message
    Route::patch('/{message}/archive', [MessageController::class, 'archive'])
        ->name('archive');

    // Désarchiver un message
    Route::patch('/{message}/unarchive', [MessageController::class, 'unarchive'])
        ->name('unarchive');
});
