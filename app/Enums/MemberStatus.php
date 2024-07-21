<?php

namespace App\Enums;

enum MemberStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';

    public static function toArray(): array
    {
        return array_column(MemberStatus::cases(), 'value');
    }
}
