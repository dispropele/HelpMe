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

        <h2 class="text-2xl font-bold text-brutal-primary mb-6">Add New User</h2>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Поле: Имя --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-brutal-primary">Name</label>
                    <input type="text" name="name" id="name" required
                           class="mt-2 block w-full bg-transparent text-brutal-primary border border-brutal-border p-3 focus:outline-none focus:border-brutal-red">
                </div>
                {{-- Поле: Пароль --}}
                <div>
                    <label for="password" class="block text-sm font-bold text-brutal-primary">Password</label>
                    <input type="password" name="password" id="password" required
                           class="mt-2 block w-full bg-transparent text-brutal-primary border border-brutal-border p-3 focus:outline-none focus:border-brutal-red">
                </div>
                {{-- Чекбокс: Админ --}}
                <div class="flex items-center">
                    <input id="is_admin" name="is_admin" type="checkbox" value="1"
                           class="h-4 w-4 bg-transparent border-brutal-border text-brutal-red focus:ring-brutal-red">
                    <label for="is_admin" class="ml-3 block text-sm text-brutal-primary">
                        Assign as Administrator
                    </label>
                </div>
            </div>

            {{-- Кнопки --}}
            <div class="mt-8 flex justify-end space-x-4">
                <button type="button" @click="showAddUserModal = false"
                        class="bg-zinc-700 text-white font-bold py-2 px-6">
                    Cancel
                </button>
                <button type="submit" class="bg-brutal-red text-white font-bold py-2 px-6">
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>
