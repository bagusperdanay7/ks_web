<?php

namespace App\Enums;

enum ArtistClassification: string
{
    case GROUP = 'Group';
    case SINGER = 'Singer';
    case MUSICIAN = 'Musician';

    public static function toArray(): array
    {
        return array_column(ArtistClassification::cases(), 'value');
    }
}
