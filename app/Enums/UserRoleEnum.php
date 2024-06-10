<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Root = 1;
    case Admin = 2;
    case User = 3;
    public function getLabel(): string
    {
        return match ($this) {
            self::Root => 'Root',
            self::Admin => 'Yönetici',
            self::User => 'Kullanıcı',
            default => 'Unknown',
        };
    }
}
