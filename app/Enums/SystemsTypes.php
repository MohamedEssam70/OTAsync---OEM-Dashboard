<?php

namespace App\Enums;

enum SystemsTypes : string
{
    case Powertrain = 'Powertrain';
    case Body = 'Body';
    case Chassis = 'Chassis';
    case Network = 'Network';
    case Undefine = 'Undefine';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}