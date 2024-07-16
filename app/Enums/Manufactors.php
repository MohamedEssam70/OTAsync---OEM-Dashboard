<?php

namespace App\Enums;

enum Manufactors : string
{
    case Generic = 'Generic';
    case OTAsync = 'OTAsync';
    case Volvo = 'Volvo';
    case Audi = 'Audi';
    case Ford = 'Ford';
    case GM = 'GM';
    case BMW = 'BMW';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}