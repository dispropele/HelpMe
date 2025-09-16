<div class="border-2 border-zinc-700 p-6
shadow-[4px_4px_0px_rgba(255,255,255,0.3)]">
    <div class="flex justify-between items-start">
{{--        Левая основная часть--}}
        <div>
            <div class="flex gap-4">
                @if($question->tags->isNotEmpty())
                    @foreach($question->tags as $tag)
                        <p class="bg-zinc-700 px-2 py-1 transition">
                            #{{$tag->name}}
                        </p>
                    @endforeach
                @endif
            </div>

            <h2 class="text-2xl font-bold mt-3">
                <a href="{{ route('question.show', $question) }}" class="hover:underline">
                    {{ $question->title }}
                </a>
            </h2>

            <p class="mt-2 text-zinc-500">
                {{ Str::limit($question->body, 150) }}
            </p>

        </div>

{{--        Правая часть с картинкой--}}
        @if($question->image_path)
            <div class="ml-6 flex-shrink-0">
                <img alt="question image"
                     class="w-16 h-16 bg-zinc-800 border border-brutal-border"
                     src="{{ asset('storage/' . $question->image_path) }}">
            </div>
        @endif
    </div>

    <div class="text-right mt-4 text-sm font-semibold">
        Ответов: {{ $question->answers_count }}
    </div>

</div>
