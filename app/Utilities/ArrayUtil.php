<?php

namespace App\Utilities;

/**
 * ArrayUtil class provides utility functions for manipulating arrays.
 * @category Utilities
 * @package App\Utilities
 */
class ArrayUtil {


    /**
     * Recursively checks if a given nested array contains all the specified values.
     * @param array $array The nested array to check.
     * @param array $keys The keys to check for.
     * @return string|null $value returns value if present and null if it does not exist.
     */
    public static function fetchNestedArrayValues($array, ...$keys) : ?string
    {
        $value = $array;
        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }

}