<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('manager.dashboard');
})->name('dashboard');

Route::get('/analytics', function () {
    return view('manager.analytics');
})->name('analytics');
