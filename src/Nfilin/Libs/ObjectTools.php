<?php
namespace Nfilin\Libs;
/**
 * Object manipulation tools
 * Class ObjectTools
 * @abstract
 * @package Nfilin\Libs
 */
abstract class ObjectTools
{
    /**
     * Recursively converts array into an object
     * @param array $arr
     * @param string $class Class of an output object
     * @return object
     */
    static function array2object(array $arr, $class = 'StdClass')
    {
        $obj = new $class;
        foreach ($arr as $key => $value) {
            $obj->{$key} = is_array($value) ? static::array2object($value, $class) : $value;
        }
        return $obj;
    }

    /**
     * Recursively converts an object into array
     * @param object|array $obj
     * @return array
     */
    static function object2array($obj)
    {
        $arr = [];
        foreach ($obj as $key => $value) {
            $arr[$key] = is_object($value) ? static::object2array($value) : $value;
        }
        return $arr;
    }
}
