<?php

namespace App\Enums;

enum UpdateTypes : string
{
    case release = 'New Release';
    case version = 'Version Update';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}