<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('home');

Route::get('/403', function () {
    return view('errors.403');
});

Route::prefix('auth')->name('auth.')->group(function () {
    // Отображение views
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    // Для данных
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Выход пользователя
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
