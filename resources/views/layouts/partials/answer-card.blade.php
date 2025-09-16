@props(['isProfile' => false])

<div class="border-2 border-zinc-500
          shadow-[3px_3px_0px_rgba(255,255,255,0.5)]
        bg-zinc-800 p-6">
    <div class="flex items-center space-x-4">
        <div class="text-zinc-300 flex flex-col gap-1">
            <div>
                @if($isProfile)
                    <span class="text-sm text-zinc-400">Ответ в:</span>
                    <a href="{{route('question.show', $answer->question)}}"
                       class="font-semibold hover:underline">
                        {{ $answer->question->title }}
                    </a>
                @else
                    <a href="{{route('profile', $answer->author)}}"
                       class="font-semibold hover:underline">
                        Ответил: {{ $answer->author->name }}
                    </a>
                @endif
                <span class="text-sm">
                ({{ $answer->created_at->diffForHumans() }})
            </span>
            </div>

{{--            Сепаратор--}}
            <span class="border-b border-b-zinc-400 my-2"></span>

            <div class="text-gray-300">
                {{ $answer->body }}
            </div>

        </div>
    </div>
</div>
