<?php

namespace App\Enums;

enum StatusEnum: int
{
    case Inactive = 0;
    case Active = 1;
    case scheduled = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::scheduled =>  'Taslak',
            self::Active    =>  'Aktif',
            self::Inactive  =>  'Pasif',
            default => 'Unknown',
        };
    }
}
