<header  class="bg-zinc-900 border-b-2 border-white">
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
                   class="bg-white border hover:bg-red-500 hover:text-white
                          cursor-pointer text-black text-xl font-bold
                          w-12 h-9 transition-colors flex items-center justify-center">
                    +
                </a>
                <a>
                    Профиль
                </a>

                <form method="POST" action="{{route('auth.logout')}}">
                    @csrf
                    <button>
                        Выйти
                    </button>
                </form>

            </div>
        @endauth
    </nav>
</header>
