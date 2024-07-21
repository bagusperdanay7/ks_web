<?php

namespace App\Enums;

enum ArtistRole: string
{
    case PRIMARY = 'Primary Artist';
    case FEATURED_ARTIST = 'Featured Artist';
    case LYRICIST = 'Lyricist';
    case COMPOSER = 'Composer';
    case ARRANGER = 'Arranger';
    case CONDUCTOR = 'Conductor';
    case PRODUCER = 'Producer';

    public static function toArray(): array
    {
        return array_column(ArtistRole::cases(), 'value');
    }
}
