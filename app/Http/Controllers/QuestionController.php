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
    public function index(Request $request)
    {
        // Получаем все популярные теги для фильтра
        $tags = Tag::withCount('questions')
                ->orderBy('question_count', 'desc')
                ->take(6)->get();

        $query = Question::query()
                 ->with('tags') //Подгружаем теги вопроса
                 ->withCount('answers') //Подгружаем кол-во ответов в answers_count
                 ->latest(); // Сортируем под дате, сначала новые

        //Проверяем фильтр на тег
        if($request->has('tag')){
            //Получаем переданный тег
            $tagName = $request->tag;
            //Отбираем вопросы по тегу
            $query->whereHas('tags', function($q) use ($tagName){
                $q->where('name', $tagName);
            });
        }

        $questions = $query->paginate(10);

        return view('question.index', [
            'questions' => $questions,
            'tags' => $tags,
        ]);
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

            $path = $file->storeAs("questions", $fileNameToStore, 'public');
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
