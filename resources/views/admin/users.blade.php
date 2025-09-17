@extends('app')

@section('title', 'Управление пользователями')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{showAddUserModal: false}">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-zinc-300">Управление пользователями</h1>
            <button @click="showAddUserModal = true"
                    class="bg-brutal-red shadow-brutal-sm font-semibold
                    cursor-pointer hover:text-black hover:bg-white
                    hover:shadow-brutal-sm-2 transition-colors
                    py-2 px-4 flex items-center border">
                <svg class="w-5 h-5 mr-2" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Добавить
            </button>
        </div>

{{--        Таблица--}}
        <div class="bg-zinc-900 border-2 border-brutal-border">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-2 divide-brutal-border">
                    <thead class="bg-zinc-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium
                                text-zinc-300 uppercase tracking-wider">
                                Логин
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium
                                text-zinc-300 uppercase tracking-wider">
                                Админ
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium
                                text-zinc-300 uppercase tracking-wider">
                                Дата создания
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium
                                text-zinc-300 uppercase tracking-wider">
                                Дата изменения
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium
                                text-zinc-300 uppercase tracking-wider">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-brutal-border">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    {{$user->name}}
                                </td>
                                <td class="whitespace-nowrap text-center text-xl font-bold text-brutal-red">
                                    @if($user->is_admin)
                                        +
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$user->created_at->format('Y-m-d')}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$user->updated_at->format('Y-m-d')}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-zinc-400 hover:text-white">
                                        Ред.
                                    </a>
                                    <span class="text-gray-600 mx-1">|</span>
                                    <a href="#" class="text-brutal-red hover:text-red-400">
                                        Удал.
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-zinc-400">
                                    Пользователи не найдены
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Пагинация --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>

        <div x-show="showAddUserModal"
             class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-30"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;">

            {{-- Контейнер модального окна --}}
            <div @click.away="showAddUserModal = false" @keydown.escape.window="showAddUserModal = false"
                 class="bg-zinc-900 border-2 border-brutal-border w-full max-w-lg p-8">

                <h2 class="text-2xl font-bold text-brutal-primary mb-6">Добавление нового пользователя</h2>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        {{-- Поле: Имя --}}
                        <div>
                            <label for="name" class="block text-sm font-bold text-brutal-primary">Логин</label>
                            <input type="text" name="name" id="name" required value="{{old('name')}}"
                                   class="mt-2 block w-full bg-transparent text-brutal-primary border border-brutal-border p-3 focus:outline-none focus:border-brutal-red">
                        </div>
                        {{-- Поле: Пароль --}}
                        <div>
                            <label for="password" class="block text-sm font-bold text-brutal-primary">Пароль</label>
                            <input type="password" name="password" id="password" required
                                   class="mt-2 block w-full bg-transparent text-brutal-primary border border-brutal-border p-3 focus:outline-none focus:border-brutal-red">
                        </div>
                        {{-- Поле: Подтверждение пароля --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-brutal-primary">Подтвердите пароль</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="mt-2 block w-full bg-transparent text-brutal-primary border border-brutal-border p-3 focus:outline-none focus:border-brutal-red">
                        </div>
                        {{-- Чекбокс: Админ --}}
                        <div class="flex items-center">
                            <input id="is_admin" name="is_admin" type="checkbox" value="1"
                                   class="h-4 w-4 bg-transparent border-brutal-border text-brutal-red focus:ring-brutal-red">
                            <label for="is_admin" class="ml-3 block text-sm text-brutal-primary">
                                Админ
                            </label>
                        </div>
                    </div>

                    {{-- Кнопки --}}
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="showAddUserModal = false"
                                class="bg-zinc-700 text-white
                                hover:bg-zinc-600 border shadow-brutal-sm
                                font-bold py-2 px-6 cursor-pointer">
                            Отмена
                        </button>
                        <button type="submit"
                                class="bg-brutal-red text-white
                                border hover:bg-red-400 shadow-brutal-sm
                                font-bold py-2 px-6 cursor-pointer">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
