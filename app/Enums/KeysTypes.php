<?php

namespace App\Enums;

enum KeysTypes : string
{
    case DownloadUpdates = 'updates';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}