@props([
    'title' => null,
    'body' => null,
])

<div class="bg-zinc-800 border-2 p-6 shadow-brutal text-center md:text-left">
    <p class="text-zinc-400 text-lg font-semibold">
        {{$title}}
    </p>
    <p class="text-4xl font-bold mt-2">
        {{number_format($body)}}
    </p>
</div>
