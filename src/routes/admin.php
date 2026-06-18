<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/analytics', function () {
    return view('admin.analytics');
})->name('analytics');
