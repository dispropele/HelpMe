<?php

namespace App\Http\Controllers;

use App\Enums\QuestionStatus;
use App\Http\Requests\Question\CreateQuestionRequest;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //Методы для отображения страниц
    public function indexForm()
    {
        return view('question.index');
    }

    public function createForm()
    {
        return view('question.create');
    }

    public function showForm(Question $question)
    {
        return view('question.show', $question);
    }

    public function create(CreateQuestionRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $path = $file->storeAs("public/questions", $fileNameToStore);
        }

        // Создаем вопрос
        $question = auth()->user()->questions()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image_path' => $path ?? null,
            'status' => QuestionStatus::Open
        ]);

        //Обработка тегов
        $tagIds = [];

        //Проверяем наличие тегов
        if ($request->has('tags') && !empty($request->tags)) {
            // Разбиваем строку на массив
            $tagNames = array_map('trim', explode(',', $request->tags));

            foreach ($tagNames as $tagName) {
                //Ищем тег в базе или создаем новый
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                //Заполняем массив тегов для синхронизации
                $tagIds[] = $tag->id;
            }
        }

        //Синхронизуем теги с вопросом
        if (!empty($tagIds)) {
            $question->tags()->sync($tagIds);
        }

        return redirect()->route('question.show', $question);
    }

}
