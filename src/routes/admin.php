<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\Admin\AnalyticsController;

Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
