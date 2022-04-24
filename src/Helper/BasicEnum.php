<?php

namespace Dipantry\Rajaongkir\Helper;

use ReflectionClass;
use ReflectionException;

abstract class BasicEnum
{
    private static array|null $constCacheArray = null;

    /* @throws ReflectionException */
    private static function getConstants()
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    /* @throws ReflectionException */
    public static function isValidValue($value, $strict = true): bool
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict);
    }
}
