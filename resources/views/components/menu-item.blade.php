@props([
    'href' => null,
    'title' => null,
])

<a class="block text-center px-4 w-full py-2 text-zinc-300 font-semibold
          hover:bg-zinc-700 hover:text-white border-b-2 border-zinc-500"
   href="{{$href}}">
    {{ $title }}
</a>
