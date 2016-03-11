<?php

namespace Nfilin\Libs;


/**
 * Class StringTools
 * @package Nfilin\Libs
 */
abstract class StringTools
{
    /**
     * @param $str
     * @return mixed
     */
    static function underscoreToCamel($str)
    {
        return str_replace('_', '', ucwords($str, '_'));
    }
}