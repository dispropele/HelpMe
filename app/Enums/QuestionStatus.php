<?php

namespace App\Enums;

enum QuestionStatus: string
{
    case Open = 'open';
    case Closed = 'closed';

    public function label(): string {
        return match ($this) {
            self::Open => '⏳ Открыт',
            self::Closed => '✅ Решен'
        };
    }

}
