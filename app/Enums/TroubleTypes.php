<?php

namespace App\Enums;

enum TroubleTypes : string
{
    case Confirmed = 'Confirmed';
    case Pending = 'Pending';
    case Permanent = 'Permanent';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}