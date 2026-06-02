<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

// Public authentication routes
Route::prefix('auth')->name('api.auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/password-reset-request', [AuthController::class, 'requestPasswordReset'])->name('password.reset.request');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password-reset-validate', [AuthController::class, 'validateResetToken'])->name('password.reset.validate');
});

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->name('api.auth.')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::get('/me', [AuthController::class, 'me'])->name('me');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
