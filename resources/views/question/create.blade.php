@extends('app')
@section('content')

    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-10 text-center">
            Создание вопроса
        </h1>

        <form method="POST" class="bg-zinc-800/50 border-2 border-white p-8 space-y-8"
              action="{{route('question.create')}}">
            @csrf
            <div>
                <label for="title" class="block mb-2 text-xl font-semibold text-gray-200">
                    Название*
                </label>
                <input type="text"
                       placeholder="Задайте какой-нибудь вопрос"
                       class="w-full bg-zinc-800 border-2
                         placeholder-gray-500
                         focus:outline-none focus:ring-2
                         focus:ring-red-400 focus:border-transparent transition-colors
                       p-3 text-gray-300
                       @error('title') border-red-400 @enderror"
                       maxlength="50"
                       id="title" value="{{old('title')}}" name="title" required>

                @error('title')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="body" class="block mb-2 font-semibold text-gray-200">
                    Тело вопроса
                </label>
                <textarea id="body" name="body" rows="6"
                          placeholder="Подробнее опишите свой вопрос"
                          class="w-full bg-zinc-800 border-2 p-3 text-gray-300
                          placeholder-gray-500 focus:outline-none focus:ring-2
                          focus:ring-red-400 focus:border-transparent transition-colors">
                </textarea>
            </div>

            <div>
                <label for="image" class="block mb-2 font-semibold text-gray-200">
                    Изображение (необязательно)
                </label>

                <label for="image-upload"
                       class="mt-4 flex flex-col justify-center
                       items-center border-2 border-dashed
                       h-48 cursor-pointer hover:border-gray-500 hover:bg-zinc-800 transition-colors">
                    <div id="placeholder" class="text-center">
                        <svg class="mx-auto h-12 w-12"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mt-2 text-brutal-primary">Перетащите или нажмите, чтобы загрузить</p>
                        <p class="text-xs text-brutal-secondary">PNG, JPG, GIF до 10MB</p>
                    </div>

                    <img id="image-preview" src=""
                         alt="Превью изображения"
                         class="hidden w-28 h-28 object-contain">

                </label>
                <input type="file" name="image"
                       accept="image/png, image/jpeg, image/gif"
                       id="image-upload" class="hidden">
            </div>

        </form>
    </div>

    <script>
        const imageUploadInput = document.getElementById('image-upload')
        const imagePreview = document.getElementById('image-preview')
        const placeholder = document.getElementById('placeholder')

        imageUploadInput.addEventListener('change', (event) => {
            const file = event.target.files[0]

            if(file) {
                const reader = new FileReader()

                reader.onload = (e) => {
                    imagePreview.src = e.target.result

                    imagePreview.classList.remove('hidden')
                    placeholder.classList.add('hidden')
                }

                reader.readAsDataURL(file)
            } else {
                imageUploadInput.value = '';
                imagePreview.src = '';

                imagePreview.classList.add('hidden')
                placeholder.classList.remove('hidden')
            }
        })
    </script>

@endsection
