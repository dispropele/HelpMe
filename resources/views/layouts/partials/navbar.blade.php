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

            @auth
{{--                Добавить ссылки для авторизованного пользователя--}}
            @endauth
        </div>

        @auth
            <div class="flex items-center space-x-4">
                <a href="{{route('question.create')}}"
                   class="bg-red-500 border text-white hover:bg-white hover:text-black
                          cursor-pointer text-xl font-bold
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
