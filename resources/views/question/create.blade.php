@extends('app')

@section('title', 'Создание вопроса')

@section('content')

    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-10 text-center">
            Создание вопроса
        </h1>

        <form method="POST"
              enctype="multipart/form-data"
              class="bg-zinc-800/50 border-2
              shadow-[5px_5px_0px_rgba(255,255,255,0.7)]
              border-zinc-500 p-8 space-y-8"
              action="{{route('question.create')}}">
            @csrf
            <div>
                <label for="title" class="block mb-2 font-semibold text-gray-200">
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
                       id="title" value="{{old('title')}}"
                       name="title" required>

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
                <textarea id="editor" name="body" rows="6"
                          class="w-full bg-zinc-800 border-2 p-3 text-gray-300
                          placeholder-gray-500 focus:outline-none focus:ring-2
                          focus:ring-red-400 focus:border-transparent
                          @error('body') border-red-400 @enderror
                          transition-colors">
                    {{old('body')}}
                </textarea>

                @error('body')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="image" class="block mb-2 font-semibold text-gray-200">
                    Изображение (необязательно)
                </label>

                <label for="image-upload"
                       class="mt-4 flex flex-col justify-center
                       items-center border-2 border-dashed
                       h-48 cursor-pointer hover:border-gray-500
                       hover:bg-zinc-800 transition-colors
                       @error('image') border-red-400 @enderror">
                    <div id="placeholder" class="text-center">
                        <svg class="mx-auto h-12 w-12"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mt-2 text-brutal-primary">Перетащите или нажмите, чтобы загрузить</p>
                        <p class="text-xs text-brutal-secondary">PNG, JPG, GIF до 5MB</p>
                    </div>

                    <img id="image-preview" src=""
                         alt="Превью изображения"
                         class="hidden w-28 h-28 object-contain">

                </label>
                <input type="file" name="image"
                       accept="image/png, image/jpeg, image/gif"
                       id="image-upload" class="hidden">

                @error('image')
                <p class="text-red-500 text-lg mt-2">
                    {{ $message }}
                </p>
                @enderror

            </div>

            <div>
                <label class="font-semibold">
                    Теги (макс. 5)
                </label>
                {{--                Пойдет в контроллер--}}
                <input type="hidden" name="tags" value="{{old('tags')}}" id="tags-input-hidden">

                {{--                Контейнер для тегов--}}
                <div id="tags-container" class="mt-2 flex items-center flex-wrap gap-2 p-2 border-2">
                    {{--                    js будет вставлять сюда добавленые теги--}}
                    <input type="text" id="tag-input-text"
                           class="flex-grow bg-transparent focus:outline-none min-w-[120px]"
                           placeholder="Добавьте тег...">
                </div>
                <p id="tag-error" class="text-brutal-red text-sm mt-1 hidden"></p>
            </div>

            <div class="flex items-center justify-center gap-5">
                <button type="submit"
                        class="bg-red-600 font-semibold text-xl
                        py-2 px-8 border-2 hover:bg-white hover:text-black transition-colors
                        shadow-[2px_2px_0px_rgba(255,255,255,0.8)]
                        hover:shadow-[3px_3px_0px_rgba(255,255,255,0.3)]
                        focus:outline-none focus:ring-2 focus:ring-offset-zinc-800
                        focus:ring-red-500 cursor-pointer">
                    Создать
                </button>

                <a href="{{route('home')}}"
                   class="font-semibold text-xl hover:text-gray-400 transition-colors">
                    Отмена
                </a>

            </div>

        </form>
    </div>

    <script>
        //Константы для изображения
        const imageUploadInput = document.getElementById('image-upload')
        const imagePreview = document.getElementById('image-preview')
        const placeholder = document.getElementById('placeholder')
        //Константы для тегов
        const tagsContainer = document.getElementById('tags-container')
        const textInput = document.getElementById('tag-input-text')
        const hiddenInput = document.getElementById('tags-input-hidden')
        const tagError = document.getElementById('tag-error')
        const MAX_TAGS = 5

        //Выбраные теги пользователем
        let tags = []

        //Функция для отрисовки тегов в контейнере
        const renderTags = () => {
            //Очищаем старые теги
            tagsContainer.querySelectorAll('.tag').forEach(tagEl => tagEl.remove())

            //Рисуем теги заново
            tags.slice().reverse().forEach((tag, index) => {
                const tagElement = createTagElement(tag)
                tagsContainer.prepend(tagElement)
            })

            hiddenInput.value = tags.join(',')
            tagError.classList.add('hidden')
        }

        //Функция для создания html элемента тега
        const createTagElement = (tag) => {
            const div = document.createElement('div')
            div.className = 'tag bg-gray-200 text-black ' +
                'text-sm font-semibold px-3 py-1 ' +
                'rounded-full flex items-center';

            const span = document.createElement('span')
            span.textContent = tag

            const closeBtn = document.createElement('button')
            closeBtn.className = 'ml-2 text-black hover:text-red-500 font-bold'
            closeBtn.innerHTML = '&times;' // Символ x
            closeBtn.addEventListener('click', () => {
                tags = tags.filter(t => t !== tag)
                renderTags()
            })

            div.appendChild(span)
            div.appendChild(closeBtn)
            return div
        }

        //Слушатель тегов
        textInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault() //Предотвращаем отправку формы или ввод запятой

                const newTag = textInput.value.trim()

                if (newTag.length > 0) {
                    if (tags.length >= MAX_TAGS) {
                        tagError.textContent = `Можно добавить не более ${MAX_TAGS} тегов.`
                        tagError.classList.remove('hidden')
                        return;
                    }
                    if (tags.includes(newTag)) {
                        tagError.textContent = 'Такой тег уже добавлен.'
                        tagError.classList.remove('hidden')
                        return;
                    }

                    tags.push(newTag)
                    textInput.value = ''
                    tagError.classList.add('hidden')
                    renderTags()
                }

            }
        })

        //Обработка выбора фотки
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

        //Создание easyMDE
        document.addEventListener('DOMContentLoaded', ()=>{
            if(document.getElementById('editor')){
                const easyMDE = new EasyMDE({
                    element: document.getElementById('editor'),
                    spellcheck: false,
                    placeholder: "Введите текст вашего вопроса.",
                    minHeight: "250px",
                })
            }
        });

    </script>

@endsection
