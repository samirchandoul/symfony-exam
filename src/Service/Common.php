<?php

namespace App\Service;

class Common
{
    /**
     * @param array<> $array
     * @return array<>
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
     * unpacking array1 and array2
     * @param array<int> $array1
     * @param array<int> $array2
     * @return array<int>
     */
    public static function foo(array $array1, array $array2): array
    {
        return [...$array1, $array2['k'] => $array2['v']];
    }

    /**
     * calculer le nombre des elements dans array1 qu'ils n'existent pas dans array2
     * @param array<> $array1
     * @param array<> $array2
     * @return bool
     */
    public static function bar(array $array1, array $array2): bool
    {
        $r = array_filter(array_keys($array1), fn ($k) => !in_array($k, $array2));

        return count($r) == 0;
    }
}
