<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'title',
        'body',
        'status',
    ];

    // Возвращаем автора вопроса
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Возвращаем ответы на вопрос
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // Возвращаем теги вопроса
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
