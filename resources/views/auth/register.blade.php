@extends('app')
@section('content')

    <div class="max-w-4xl mx-auto">

        <h1 class="text-4xl font-bold mb-10 text-center">
            Регистрация
        </h1>

        <form method="POST" action="{{route('auth.register')}}"
              class="bg-zinc-800/55 border-2 border-white p-8 space-y-8">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-xl font-semibold text-gray-200">
                    Логин
                </label>
                <input type="text"
                       placeholder="user123"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       p-3 text-gray-300
                       @error('name') border-red-400 @enderror"
                       id="name" name="name" value="{{old('name')}}">

                @error('name')
                    <p class="text-red-500 text-lg mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div>
                <label for="password" class="block mb-2 text-xl font-semibold text-gray-200">
                    Пароль
                </label>
                <input type="password"
                       placeholder="*********"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       @error('password') border-red-400 @enderror p-3 text-gray-300"
                       id="password" name="password">

                @error('password')
                    <p class="text-red-500 text-lg mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 text-xl font-semibold text-gray-200">
                    Повторите пароль
                </label>
                <input type="password"
                       placeholder="*********"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       p-3 text-gray-300
                       @error('password_confirmation') border-red-400 @enderror"
                       id="password_confirmation" name="password_confirmation">

                @error('password_confirmation')
                    <p class="text-red-500 text-lg mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-center items-center gap-5">
                <button type="submit"
                        class="bg-red-600 text-white font-semibold text-xl
                        py-2 px-8 border-2 hover:bg-red-700 transition-colors
                        focus:outline-none focus:ring-2 focus:ring-offset-zinc-800
                        focus:ring-red-500 cursor-pointer">
                    Зарегистрироваться
                </button>
                <a class="text-gray-300 text-lg cursor-pointer hover:text-gray-400 transition-colors">
                    Забыли пароль?
                </a>
            </div>
        </form>

    </div>

@endsection
