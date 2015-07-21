<?php

namespace Nfilin\Libs;

use Exception;


/**
 */
class InputData {

	/**
	 * @var object Data container
	 */
	protected $__data;

	/**
	 * [[InputData]] constructor
	 * @param array|object|null $data
	 */
	function __construct($data = []){
		$this->__data = new \StdClass;
		$this->mergeWith($data);
	}

	/**
	 * Creates new [[InputData]] instance
	 * @param array|object|null $data
	 * @return InputData
	 */
	static function create($data = []) {
		return new static($data);
	}

	/**
	 * Gets the property
	 * @param string|int|float|boolean $key
	 * @return mixed
	 */
	function __get($key){
		return isset($this->__data->{$key}) ? $this->__data->{$key} : null;
	}

	/**
	 * Sets the property
	 * @param string|int|float|boolean $key
	 * @param mixed $value
	 */
	function __set($key,$value){
		$this->__data->{$key} = $value;
	}

	/**
	 * Returns if property exists in storage
	 * @param string|int|float|boolean $key
	 * @return boolean
	 */
	function __isset($key){
		return property_exists($this->__data, $key);
	}

	/**
	 * Removes property from storage
	 * @param string|int|float|boolean $key
	 */
	function __unset($key){
		unset($this->__data->{$key});
	}

	/**
	 * Adds data to storage
	 * @param array|object|null $data
	 * @return InputData
	 */
	function mergeWith($data = []){
		if(is_array($data) || is_object($data))
			foreach ($data as $key => $value) {
				$this->__data->{$key} = $value;
			}
		return $this;
	}


	/**
	  * Standartise `type`,`target` and `types`
	 * @param array|object|string $rule
	  * @return array 
	  */
	static protected function parseRule($rule){		
		switch(gettype($rule)){
			case 'string':
				$type = $rule;
				$target = null;
				$types = [];
				break;								
			case 'array':
				$type   = isset($rule['type']) ? $rule['type'] : [];
				$target = isset($rule['target']) ? $rule['target'] : [];
				$types  = isset($rule['types']) ? $rule['types'] : [];
				break;								
			case 'object':
				$type = isset($rule->type) ? $rule->type : null;
				$target = isset($rule->target) ? $rule->target : null;
				$types = isset($rule->types) ? $rule->types : [];
				break;
			default:
				$type = null;
				$target = null;
				$types = [];
		}
		return compact('type','target','types');
	}

	/**
	  * Checks if field match type
	  * @param array $input Array with result of [[parseRule()]]
	  * @return boolean|null
	  */
	protected function parseType(array $input){
		extract($input);
		switch($type){
			case 'array':
				if(!is_array($this->{$key}))
					return false;
				break;
			case 'int':
			case 'integer':
				if(!is_int($this->{$key}))
					return false;
				break;
			case 'or':
				$valid = false;
				foreach ($types as $_type) {
					if(gettype($this->{$key}) == $_type){
						$valid = true;
						break;
					}
				}
				if(!$valid)  return false;
				break;
			default:
				//throw new Exception('Incorrect rule');
				return null;
		}
		return true;
	}

	/**
	 * Validates data in storage.
	 * @param array|object|string $rules
	 * @return boolean
	 * @throw Exception If invalid rule provided
	 */
	function validate($rules = []){
		switch(gettype($rules)){
			case 'string':
				return !empty($this->{$rules});
				break;
			case 'array':
			case 'object':
				foreach ($rules as $key => $rule) {
					if(is_numeric($key)){
						if(empty($this->{$rule}))
							return false;
					} else {
						if(!isset($this->{$key}))
							return false;
						$_vars = self::parseRule($rule);
						$_vars['key'] = $key;
						$valid = $this->parseType($_vars);
						if($valid === null)
							throw new Exception('Incorrect rule: '.json_encode($rule));
						elseif(!$valid)
							return false;
					}
				}
				break;
			default:
				throw new Exception('Incorrect rule: '.json_encode($rules));
		}
		return true;
	}
	
}
