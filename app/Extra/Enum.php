<?php

namespace App\Extra;

class Enum
{
    /**
     * Get all defined constants.
     *
     * @return array
     */
    protected static function constants(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * Get the keys of defined constants.
     *
     * @return array
     */
    public static function keys(): array
    {
        return array_keys(static::constants());
    }

    /**
     * Get the values of defined constants.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_values(static::constants());
    }
}
