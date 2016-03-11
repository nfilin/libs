<?php

namespace Nfilin\Libs;

use ArrayAccess;
use Iterator;
use Countable;
use Exception;

/**
 * Class BaseIterator
 * @package Nfilin\Libs
 */
class BaseIterator implements Iterator, ArrayAccess, Countable
{
    use BaseTrait;

    /**
     * @var array
     */
    private $storage = [];

    /**
     * BaseIterator constructor.
     * @param array $data
     * @throws Exception
     */
    public function __construct($data = [])
    {
        if (is_array($data)) {
            $this->storage = $data;
        } elseif (is_object($data) && $data instanceof BaseIterator) {
            $this->storage = $data->getArrayCopy();
        } else {
            throw new Exception('Argument 1 should be an instance of BaseIterator or array');
        }
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $key = $this->key();
        return array_key_exists($key, $this->storage);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->storage);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->storage);
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->storage);
    }

    /**
     *
     */
    public function next()
    {
        next($this->storage);
    }

    /**
     *
     */
    public function clear()
    {
        unset($this->storage);
        $this->storage = [];
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->storage);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->storage);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->storage[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->storage[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
    }

    /**
     * @param $value
     */
    public function append($value)
    {
        $this->storage[] = $value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public function __call($name, $arguments)
    {
        if (function_exists($name)) {
            return call_user_func_array($name, $arguments);
        } else {
            return null;
        }
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->storage;
    }
}