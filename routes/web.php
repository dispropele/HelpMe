<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('home');

Route::prefix('auth')->name('auth.')->group(function () {
    // Отображение
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    // Для данных
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Выход пользователя
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function(){

    // Маршруты с вопросами
    Route::prefix('question')->name('question.')->group(function(){
        Route::get('/create', [QuestionController::class, 'createForm'])->name('create');
        Route::post('/create', [QuestionController::class, 'create']);

        Route::get('/', [QuestionController::class, 'indexForm'])->name('index');
        Route::get('/{question}', [QuestionController::class, 'showForm'])->name('show');
    });
});

//Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//    Route::get('/dashboard', function () {
//        return view('admin.dashboard');
//    })->name('dashboard');
//});
