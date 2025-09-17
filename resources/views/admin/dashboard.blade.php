@extends('app')

@section("title", 'Главная панель админки')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-zinc-300 mb-6">
            Дашборд
        </h1>

{{--        Карточки статистики--}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <x-dashboard-card title="Всего пользователей" body="{{$totalUsers}}"/>
            <x-dashboard-card title="Всего вопросов" body="{{$totalQuestions}}"/>
            <x-dashboard-card title="Всего ответов" body="{{$totalAnswers}}"/>

        </div>

{{--        Потом можно добавить последнюю активность--}}

    </div>

@endsection
