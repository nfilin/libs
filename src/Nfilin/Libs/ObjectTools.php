<?php

namespace zeus;

/**
 * Object manipulation tools
 */
abstract class ObjectTools {

	/**
	 * Recursivly converts array into an object
	 * @param array $arr 
	 * @param string $class Class of an output object
	 * @return object
	 */
	static function array2object(array $arr, $class = 'StdClass'){
		$obj = new $class;
		foreach ($arr as $key => $value) {
			$obj->{$key} = is_array($value) ? static::array2object($value,$class) : $value;
		}
		return $obj;
	}
	/**
	 * Recursivly converts an object into array
	 * @param object $obj
	 * @return array
	 */
	static function object2array($obj){
		$arr = [];
		foreach ($obj as $key => $value) {
			$arr[$key] = is_object($value) ? static::object2array($value) : $value;
		}
		return $arr;
	}
}