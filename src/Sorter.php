<?php

namespace Rmtram\Sorter;

/**
 * Class Sorter
 * @package Rmtram\Sorter
 */
class Sorter {

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @var array
     */
    protected $refuses = array();

    /**
     * @var int|null
     */
    protected $limit;

    /**
     * @var int|null
     */
    protected $offset;

    /**
     * @param array $items
     * @return Sorter
     */
    public static function make(array $items)
    {
        return new self($items);
    }

    /**
     * @param array $items
     */
    private function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param int|null $int
     * @return $this
     */
    public function limit($int = null)
    {
        if (filter_var($int, FILTER_VALIDATE_INT) || is_null($int)) {
            $this->limit = $int;
        }
        return $this;
    }

    /**
     * @param int|null $int
     * @return $this
     */
    public function offset($int = null)
    {
        if (is_null($int)) {
            $this->offset = $int;
            return $this;
        }
        if (filter_var($int, FILTER_VALIDATE_INT) && $int > 0) {
            $this->offset = --$int;
        }
        return $this;
    }

    /**
     * @param array|string|int $key
     * @return $this
     */
    public function refuse($key)
    {
        if (is_array($key)) {
            foreach ($key as $k) {
                $this->refuses[$k] = true;
            }
        } else if (is_string($key) || is_int($key)) {
            $this->refuses[$key] = true;
        }
        return $this;
    }

    /**
     * @param array $option
     * @return array
     */
    public function sort(array $option)
    {
        $items = $this->items;

        $this->filter($items, $option);

        $this->resetRefuse();

        if (empty($option) || empty($items)) {
            return $items;
        }

        $tmp = array();
        foreach ($items as $item) {
            foreach ($option as $key => $val) {
                $tmp[$key][] = $item[$key];
            }
        }

        $args = array();

        foreach ($option as $key => $val) {
            $args[$key] = $tmp[$key];
            $args[] = strtolower($val) === 'desc' ? SORT_DESC : SORT_ASC;
        }

        $args[] = &$items;
        call_user_func_array('array_multisort', $args);

        return $this->slice($items);
    }


    protected function slice(array $items)
    {
        if (is_null($this->limit) && is_null($this->offset)) {
            return $items;
        }
        $offset = is_null($this->offset) ? 0 : $this->offset;
        return array_slice($items, $offset, $this->limit);
    }

    /**
     * reset refuse field.
     */
    protected function resetRefuse()
    {
        $this->refuses = array();
    }

    /**
     * @param array $items
     * @param array $option
     * @return void
     */
    protected function filter(array &$items, array &$option)
    {
        if (empty($this->refuses)) {
            return;
        }

        $keys = array_keys($this->refuses);

        foreach ($keys as $key) {
            if (isset($option[$key])) {
                unset($option[$key]);
            }
            foreach ($items as &$item) {
                if (isset($item[$key])) {
                    unset($item[$key]);
                }
            }
        }

    }

}