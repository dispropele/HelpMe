@extends('app')

@section('title', 'Просмотр вопроса')

@section('content')

    <div class="max-w-4xl mx-auto">

{{--        Секция вопроса--}}
        <div class="border-2 border-zinc-500 p-8 bg-zinc-800">
{{--            Заголовок вопроса --}}
            <h1 class="text-4xl font-semibold">
                {{ $question->title }}
            </h1>

{{--            От кого и когда--}}
            <div class="text-zinc-400 text-sm mt-4">
                от
                <a href="{{route('profile', $question->author)}}" class="hover:underline">
                    {{ $question->author->name }}
                </a>
                ({{ $question->created_at->diffForHumans() }})
            </div>

{{--            Содержимое вопроса--}}
            <div class="mt-4 text-lg text-zinc-300 leading-relaxed space-y-4">
                {{ $question->body }}
            </div>

            @if($question->image_path)
                <div class="mt-8">
                    <img alt="Изображение к вопросу"
                         class="max-w-full h-auto"
                        src="{{ asset('storage/' . $question->image_path) }}">
                </div>
            @endif

{{--            Проверка пользователя--}}
            @if($question->user_id === auth()->id())

            @endif

        </div>

{{--        Секция ответов --}}
        <div class="mt-12">
            <h2 class="text-3xl font-semibold mb-6">
                Ответов ({{ $question->answers->count() }})
            </h2>

            <div class="space-y-6">
                @forelse($question->answers as $answer)
                    @include('layouts.partials.answer-card')
                @empty
                    <div class="border border-zinc-500 bg-zinc-800 p-6 text-center font-semibold text-lg">
                        <p>На этот вопрос еще нет ответов. Будьте первым!</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{--Форма добавления ответа для авторизованых пользователей--}}
        @auth
            <div class="mt-12">
                <h2 class="text-2xl font-semibold mb-4">
                    Ответить на вопрос
                </h2>
                <form action="{{ route('question.answer.store', $question) }}" method="POST">
                    @csrf
                    <div>
                        <textarea name="body" id="body"
                                  rows="6" placeholder="Напишите свой ответ"
                                  class="w-full bg-zinc-800 focus:outline-none border-2
                                  border-zinc-500 p-4">
                            {{old('body')}}
                        </textarea>
                        @error('body')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit"
                                class="bg-red-500 font-semibold py-3 px-10 border-2
                                hover:bg-white hover:text-black transition-colors cursor-pointer">
                            Ответить
                        </button>
                    </div>
                </form>
            </div>
        @endauth

    </div>



@endsection


