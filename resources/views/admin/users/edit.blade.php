@extends('app')

@section('title', 'Редактирование '.$user->name)

@section('content')

    <div class="max-w-2xl mx-auto">

        <form action="{{route('admin.users.edit', $user)}}"
              method="POST"
              class="bg-zinc-800 border-2 border-brutal-border p-8">
            @csrf
            @method('PUT')
            <h2 class="text-2xl font-bold text-brutal-primary mb-6">
                Редактирование: {{$user->name}}
            </h2>

{{--         Логин--}}
            <div>
                <label for="name" class="block mb-2 text-lg font-semibold text-gray-200">
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
                       maxlength="50"
                       id="name" value="{{old('name', $user->name ?? '')}}" name="name" required>

                @error('name')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mt-4 mb-2 text-lg font-semibold text-gray-200">
                    Новый пароль
                </label>
                <input type="password"
                       placeholder="*********"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       p-3 text-gray-300
                       @error('password') border-red-400 @enderror"
                       maxlength="50"
                       id="password" name="password">
                @error('password')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block mt-4 mb-2 text-lg font-semibold text-gray-200">
                    Подтвердите пароль
                </label>
                <input type="password"
                       placeholder="*********"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       p-3 text-gray-300
                       @error('password_confirmation') border-red-400 @enderror"
                       maxlength="50"
                       id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex justify-center items-center mt-6 gap-5">
                <button type="submit"
                        class="bg-red-600 text-white font-semibold text-xl
                        py-2 px-8 border-2 hover:bg-white transition-colors
                        shadow-brutal-sm hover:shadow-brutal-sm-2 hover:text-black
                        focus:outline-none focus:ring-2 focus:ring-offset-zinc-800
                        focus:ring-red-500 cursor-pointer">
                    Сохранить
                </button>
                <a href="{{route('admin.users.index')}}"
                   class="text-gray-300 text-lg cursor-pointer hover:text-gray-400 transition-colors">
                    Отмена
                </a>
            </div>
        </form>

    </div>

@endsection
