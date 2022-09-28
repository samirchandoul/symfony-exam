<?php

namespace App\Service;

class Common
{
    /**
     * ???
     */
    public static function boo(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($a) use (&$result) {
            $result[] = $a;
        });

        return $result;
    }

    /**
     * ???
     */
    public static function foo(array $array1, array $array2): array
    {
        return [...$array1, $array2['k'] => $array2['v']];
    }

    /**
     * ???
     */
    public static function bar(array $array1, array $array2): bool
    {
        $r = array_filter(array_keys($array1), fn ($k) => !in_array($k, $array2));

        return count($r) == 0;
    }
}
