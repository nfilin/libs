<?php

namespace Nfilin\Libs;

/**
 * Class BaseObject
 * @package Nfilin\Libs
 */
abstract class BaseObject
{
    /**
     * @return string
     */
    public static function className(){
        return get_called_class();
    }
}