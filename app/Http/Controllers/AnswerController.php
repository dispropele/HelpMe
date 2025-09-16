<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:10000'
        ]);

        $question->answers()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
