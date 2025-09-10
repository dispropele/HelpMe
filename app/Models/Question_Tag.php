<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question_Tag extends Model
{
    protected $fillable = [
        'question_id',
        'tag_id',
    ];
}
