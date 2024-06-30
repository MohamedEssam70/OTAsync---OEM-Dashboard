<?php

namespace App\Enums;

enum Units : string
{
    case Undefined = '';
    case Percentage = '%';
    case Celsius = '°C';
    case Kilopascal = 'kPa';
    case RPM = 'RPM';
    case Kilometre = 'km';
    case KilometrePerHour = 'km/h';
    case GramPerSecond = 'g/s';
    case Voltage = 'V';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}