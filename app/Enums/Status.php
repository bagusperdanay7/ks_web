<?php

namespace App\Enums;

enum Status: string
{
    case COMPLETED = 'Completed';
    case IN_PROGRESS = 'In Progress';
    case PENDING = 'Pending';
    case REJECTED = 'Rejected';

    public static function toArray(): array
    {
        return array_column(Status::cases(), 'value');
    }
}
