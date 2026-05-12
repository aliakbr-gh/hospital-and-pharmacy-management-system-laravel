<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'))->name('register');

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard.dashboard'));
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'getAllUsers']);
    });
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
