<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case GATEWAY = "Gateway";
    case SENSOR = "Sensör";
    case BUILDING = "Alan";
    case INVENTORY = "Envanter";
    case EMPLOYEES = "Personel";
    public function getLabel(): string
    {
        return match ($this) {
            self::GATEWAY => 'Gateway',
            self::SENSOR => 'Sensör',
            self::BUILDING => 'Yapı',
            self::INVENTORY => 'Envanter',
            self::EMPLOYEES => 'Personel',
            default => 'Unknown',
        };
    }
    public function name(): string
    {
        return match ($this) {
            self::GATEWAY => 'gateway',
            self::SENSOR => 'sensor',
            self::BUILDING => 'building',
            self::INVENTORY => 'inventor',
            self::EMPLOYEES => 'employee',
            default => 'Unknown',
        };
    }
}
