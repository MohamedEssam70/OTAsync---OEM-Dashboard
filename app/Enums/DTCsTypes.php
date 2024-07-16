<?php

namespace App\Enums;

enum DTCsTypes : string
{
    case P = 'P';
    case B = 'B';
    case C = 'C';
    case U = 'U';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}