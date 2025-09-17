<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Users\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuestionController::class, 'index'])->name('home');

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

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');

Route::prefix('question')->name('question.')->group(function(){
    //Требующие авторизации
    Route::middleware('auth')->group(function(){
        Route::get('/create', [QuestionController::class, 'createForm'])
            ->name('create');
        Route::post('/create', [QuestionController::class, 'store']);

        //Ответы
        Route::post('/{question}/answer/create', [AnswerController::class, 'store'])
            ->name('answer.store');
    });

    //Публичные пути
    Route::get('/{question}', [QuestionController::class, 'show'])->name('show');
});

//Маршруты админа
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/users')->name('users.')->group(function(){
        ///Отображение всех пользователей
        Route::get('/', [AdminController::class, 'users'])->name('index');
        //Добавление пользователя
        Route::post('/', [UserController::class, 'store'])->name('store');

        //Редактирование пользователя
        Route::get('/{user}/edit', [UserController::class, 'update'])->name('update');
        Route::put('/{user}', [UserController::class, 'edit'])->name('edit');
    });

    Route::get('/questions', [AdminController::class, 'questions'])->name('questions');
    Route::get('/tags', [AdminController::class, 'tags'])->name('tags');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
});
