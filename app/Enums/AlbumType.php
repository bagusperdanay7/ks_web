<?php

namespace App\Enums;

enum AlbumType: string
{
    case SINGLE = 'Single';
    case EP = 'EP';
    case ALBUM = 'Album';
    case COLLECTION = 'Collection';

    public static function toArray(): array
    {
        return array_column(AlbumType::cases(), 'value');
    }
}
