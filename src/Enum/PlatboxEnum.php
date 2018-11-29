<?php

namespace Platbox\Enum;

use ReflectionClass;

/**
 * Class PlatboxEnum
 *
 * @package Platbox\Enum
 */
abstract class PlatboxEnum
{
    /**
     * Return all constants for class
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function all()
    {
        $oClass = new ReflectionClass(get_called_class());
        return $oClass->getConstants();
    }
}
