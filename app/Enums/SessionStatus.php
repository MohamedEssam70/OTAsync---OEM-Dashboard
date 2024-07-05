<?php

namespace App\Enums;

enum SessionStatus : string
{
    case Active = 'Active';
    case Closed = 'Closed';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}