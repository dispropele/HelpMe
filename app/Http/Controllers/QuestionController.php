<?php

namespace App\Http\Controllers;

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

    public function showForm()
    {
        return view('question.show');
    }
}
