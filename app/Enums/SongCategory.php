<?php

namespace App\Enums;

enum SongCategory: string
{
    case TITLE = 'Title Track';
    case TRACK = 'Track';

    public static function toArray(): array
    {
        return array_column(SongCategory::cases(), 'value');
    }
}
