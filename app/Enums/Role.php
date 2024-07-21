<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case EDITOR = 'editor';

    public static function toArray(): array
    {
        return array_column(Role::cases(), 'value');
    }
}
