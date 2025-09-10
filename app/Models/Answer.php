<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'user_id',
        'body',
        'is_best_answer',
    ];

    // Возвращаем вопрос ответа
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Возвращаем пользователя ответа
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
