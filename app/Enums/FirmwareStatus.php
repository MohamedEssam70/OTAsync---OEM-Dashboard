<?php

namespace App\Enums;

enum FirmwareStatus : string
{
    case Valid = 'Valid';
    case Expired = 'Expired';
    case Beta = 'Beta';
    case Expires_Soon = 'Expires soon';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}