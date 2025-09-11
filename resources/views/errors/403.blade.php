@extends('app')

@section('content')
    <div class="flex items-center justify-center">

        <div class="max-w-lg w-full text-center border-2 p-10">
            <h1 class="text-8xl font-black text-white">403</h1>

            <p class="text-2xl font-bold mt-4 text-zinc-500">
                У вас нет прав на просмотр данной страницы
            </p>

            <div class="mt-8">
                <a href="#"
                    onclick="window.history.back(); return false;"
                    class="inline-block bg-red-500 font-semibold py-3 px-10 border-2 hover:bg-opacity-90">
                    Вернуться обратно
                </a>
            </div>

        </div>

    </div>
@endsection
