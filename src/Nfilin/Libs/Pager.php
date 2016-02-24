<?php
namespace Nfilin\Libs;

/**
 * Creates paged response object
 * Class Pager
 * @abstract
 * @package Nfilin\Libs
 */
abstract class Pager extends BaseObject
{
    /**
     * @var integer Query limit
     */
    public $limit = 100;
    /**
     * @var integer Query offset
     */
    public $offset = 0;
    /**
     * @var integer Query total count
     */
    public $total_count = 0;
    /**
     * @var array Array of result objects
     */
    public $objects = [];
    /**
     * @var mixed Query
     */
    protected $query;

    /**
     * @param mixed $query
     */
    abstract function __construct($query = null);

    /**
     * @param mixed $query
     * @return static
     */
    static function create($query = null)
    {
        return new static($query);
    }

    /**
     * @param int $limit
     * @return $this
     */
    function limit($limit)
    {
        $this->limit = (int)$limit ?: 100;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    function offset($offset)
    {
        $this->offset = (int)$offset ?: 0;
        return $this;
    }

    /**
     * Builds response from query
     * @return $this
     */
    abstract function build();
}
