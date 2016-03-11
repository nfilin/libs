<?php

namespace Nfilin\Libs;


/**
 * Class BaseTrait
 * @package Nfilin\Libs
 */
trait BaseTrait
{
    /**
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        if (method_exists($this, 'get' . ucfirst($name))) {
            return true;
        } elseif (method_exists($this, 'get' . StringTools::underscoreToCamel($name))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (method_exists($this, $func = 'get' . ucfirst($name))) {
            return call_user_func([$this, $func]);
        } elseif (method_exists($this, $func = 'get' . StringTools::underscoreToCamel($name))) {
            return call_user_func([$this, $func]);
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (method_exists($this, $func = 'set' . ucfirst($name))) {
            call_user_func([$this, $func], $value);
        } elseif (method_exists($this, $func = 'set' . StringTools::underscoreToCamel($name))) {
            call_user_func([$this, $func], $value);
        }
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        if (method_exists($this, $func = 'set' . ucfirst($name))) {
            call_user_func([$this, $func], null);
        } elseif (method_exists($this, $func = 'set' . StringTools::underscoreToCamel($name))) {
            call_user_func([$this, $func], null);
        }
    }
}