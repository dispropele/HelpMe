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
                                    <a href="{{route('admin.users.update', $user)}}" class="text-zinc-400 hover:text-white">
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

        <x-user-modal/>

        {{-- Пагинация --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

@endsection
