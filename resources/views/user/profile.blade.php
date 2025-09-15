@extends('app')

@section('title', 'Профиль '.$user->name)

@section('content')

    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-semibold text-zinc-300">
            {{ $user->name }}
        </h1>
        <p class="text-zinc-500 text-sm mt-4">
            На сайте с {{ $user->created_at->format('d.m.Y') }}
        </p>
    </div>

    <div class="max-w-4xl mx-auto mt-8">

{{--        Табы--}}
        <div class="flex justify-around">
            <a href="{{route('profile', ['user'=>$user, 'tab' => 'questions'])}}"
               class="py-4 px-6 text-lg font-semibold w-100 flex justify-center
               {{$activeTab === 'questions' ? 'border-b-4 border-red-500' : 'text-zinc-500 border-b-4 border-zinc-800'}}">
                Вопросы
            </a>
            <a href="{{route('profile', ['user'=>$user, 'tab' => 'answers'])}}"
               class="py-4 px-6 text-lg font-semibold w-100 flex justify-center
               {{$activeTab === 'answers' ? 'border-b-4 border-red-500' : 'text-zinc-500 border-b-4 border-zinc-800'}}">
                Ответы
            </a>
        </div>

{{--        Контент табы--}}
        <div class="mt-8 space-y-6">
            @forelse($items as $item)

                @if($activeTab === 'questions')
                    @include('layouts.partials.question-card', ['question' => $item])
                @else
                    @include('layouts.partials.answer-card', ['answer' => $item, 'isProfile' => true])
                @endif

            @empty
                <p class="text-zinc-300 text-center">
                    Здесь пока ничего нет.
                </p>

            @endforelse
        </div>


    </div>


@endsection
