<header  class="bg-zinc-900 border-b-2 border-zinc-400">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-8">
{{--            Главная--}}
            <a href="{{route('home')}}">
                <span class="font-bold text-xl">
                    Help.me
                </span>
            </a>

{{--            Ссылки--}}
            @guest
                <div class="flex items-center justify-center text-xl space-x-6">
                    <a href="{{route('auth.login')}}">
                        Вход
                    </a>
                    <a href="{{route('auth.register')}}">
                        Регистрация
                    </a>
                </div>
            @endguest

        </div>

        @auth
            <div class="flex items-center space-x-4">

                <div x-data="{open: false}">
                    <button @click="open = !open"
                            class="flex items-center text-sm font-semibold
                        text-gray-300 hover:text-white focus:outline-none transition">
                        <span>Меню</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-48
                     bg-zinc-800 border border-brutal-border shadow-lg z-20"
                         style="display: none">
                        <a class="block px-4 py-2 text-sm text-gray-300 hover:bg-zinc-700 hover:text-white">
                            Пользователи
                        </a>
                    </div>
                </div>

                <a href="{{route('question.create')}}"
                   class="bg-red-500 border text-white hover:bg-white hover:text-black
                          cursor-pointer text-xl font-bold
                          shadow-[2px_2px_0px_rgba(255,255,255,0.8)]
                          hover:shadow-[3px_3px_0px_rgba(255,255,255,0.2)]
                          w-12 h-9 transition-colors flex items-center justify-center">
                    +
                </a>
                <a href="{{route('profile', auth()->user())}}"
                   class="text-zinc-300 font-semibold hover:text-zinc-400 transition-colors">
                    Профиль
                </a>

                <form method="POST" action="{{route('auth.logout')}}">
                    @csrf
                    <button class="text-zinc-300 font-semibold cursor-pointer
                    hover:text-zinc-400 transition-colors">
                        Выйти
                    </button>
                </form>

            </div>
        @endauth
    </nav>
</header>
