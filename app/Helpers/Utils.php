<?php

namespace App\Helpers;

class Utils
{
    public static function copyNoNullProperties($source, &$target)
    {
        foreach ($source as $key => $value) {
            if (!is_null($value)) {
                $target->$key = $value;
            }
        }
    }

    public static function getNullPropertyNames($object)
    {
        $emptyNames = [];
        foreach ($object as $key => $value) {
            if (is_null($value)) {
                $emptyNames[] = $key;
            }
        }
        return $emptyNames;
    }
}
