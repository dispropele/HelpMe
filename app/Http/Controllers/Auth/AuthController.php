<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Отображение формы входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Отображение формы регистрации
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Логика входа в систему
    public function login(LoginRequest $request)
    {
        $request->validated();

        if(Auth::attempt($request->only('name', 'password'), $request->boolean('remember')))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['name' => 'Неверные данные учетной записи.'])->withInput();
    }

    // Логика регистрации
    public function register(RegisterRequest $request)
    {
        // Валидация
        $validated = $request->validated();

        // Создание пользователя
        $user = User::create([
            'name' => $validated['name'],
            'password' => $validated['password'],
        ]);

        // Логиним его
        Auth::login($user);

        // Перенаправляем на /
        return redirect()->route('home');
    }

    // Логика выхода
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
