<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-gray-200 antialiased">


    <div id="app" class="min-h-screen">
        @include('layouts.partials.navbar')

        <main class="container mx-auto px-6 py-12">
            @yield('content')
        </main>

    </div>

</body>
</html>
