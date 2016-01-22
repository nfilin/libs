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
     * Creates new instance of [[Pager]]
     * @param mixed $query
     * @return Pager
     */
    static function create($query = null)
    {
        return new static($query);
    }

    /**
     * Sets limit
     * @param integer $limit
     * @return Pager
     */
    function limit($limit)
    {
        $this->limit = (int)$limit ?: 100;
        return $this;
    }

    /**
     * Sets offset
     * @param integer $offset
     * @return Pager
     */
    function offset($offset)
    {
        $this->offset = (int)$offset ?: 0;
        return $this;
    }

    /**
     * Builds response from query
     * @return Pager
     */
    abstract function build();
}
