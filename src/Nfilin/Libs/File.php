<?php
namespace Nfilin\Libs;

use ArrayIterator;

/**
 * Class File
 * Wrapper class for $_FILE records
 * @package Nfilin\Libs
 *
 * @abstract
 * @property string $name File name
 * @property string $type File mime type
 * @property string $tmp_name File location
 * @property integer $error Error code
 * @property integer $size File size
 */
abstract class File extends ArrayIterator
{
    /**
     * @param array|object $data
     * @param int $flags
     */
    function __construct($data = [], $flags = 0)
    {
        parent::__construct(['name' => null, 'type' => null, 'tmp_name' => null, 'error' => 0, 'size' => 0], $flags);
        if (is_object($data) || is_array($data))
            foreach ($data as $key => $value)
                $this->offsetSet($key, $value);
    }

    /**
     * Upload from temp directory
     * @param string $dir Target directory
     * @param string $name New file name
     */
    abstract function upload($dir = null, $name = null);

    /**
     * @param $key
     * @return mixed
     */
    function __get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * @param $key
     * @param $value
     */
    function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }
}
