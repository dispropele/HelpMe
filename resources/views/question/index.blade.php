@extends('app')

@section('title', 'Все вопросы')

@section('content')

    <div class="mx-auto">
        <h1 class="text-4xl font-bold mb-4">
            Все вопросы
        </h1>

{{--        Блок с тегами--}}
        <div class="mb-8">
            <p class="mb-4 font-semibold text-zinc-500">Фильтр по тегам:</p>
            <div class="flex flex-wrap gap-2 mb-5">
                @foreach($tags as $tag)
                    <a href="{{ route('home', ['tag' => $tag->name]) }}"
                       class="bg-zinc-700 px-4 py-1 hover:bg-zinc-600 transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <a href="{{ route('home')}}"
               class="inline-flex items-center gap-2
               px-4 py-2 border-2 border-white/20
               text-sm font-semibold hover:bg-white/5
               shadow-[3px_3px_0px_rgba(255,255,255,0.1)]
               hover:border-white/30 transition-colors">
                Сбросить фильтры
            </a>

        </div>

{{--        Контейнер для списка вопросов --}}
        <div class="space-y-4" id="question-list">
            @forelse($questions as $question)
                @include('layouts.partials.question-card')
            @empty
                <div class="border-2 border-zinc-700 p-6 text-center font-semibold">
                    <p>Пока нет ни одного вопроса. Может, вы хотите
                        <a href="{{route('question.create')}}"
                           class="text-red-500 underline">задать первый</a>?
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $questions->links() }}
        </div>

    </div>


@endsection
