<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 22.01.16
 * Time: 14:40
 */

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
    public static function getClass(){
        return get_called_class();
    }
}