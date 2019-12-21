<?php
declare(strict_types=1);

namespace Rmtram\Sorter;

/**
 * Class Sorter
 * @package Rmtram\Sorter
 */
class Sorter
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $select = [];

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var int|null
     */
    private $offset;

    /**
     * @param array $items
     * @return Sorter
     */
    public static function make(array $items): self
    {
        return new self($items);
    }

    /**
     * @param array $items
     * @param array $orders
     * @param array $select
     * @param int|null $offset
     * @param int|null $limit
     * @return array
     */
    public static function runSort(
        array $items,
        array $orders,
        array $select = [],
        ?int $offset = null,
        ?int $limit = null
    ): array {
        return (new self($items))->select($select)->offset($offset)->limit($limit)->sort($orders);
    }

    /**
     * @param array $items
     */
    private function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param int|null $limit
     * @return $this
     */
    public function limit(?int $limit = null): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return $this
     */
    public function offset(?int $offset = null): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function select(array $attributes): self
    {
        if (!empty($attributes)) {
            $attributes = array_flip($attributes);
        }
        $this->select = $attributes;
        return $this;
    }

    /**
     * @param array $orders
     * @return array
     */
    public function sort(array $orders): array
    {
        $items = $this->filterItems($this->items);
        $orders = $this->filterOrders($orders);

        if (empty($orders) || empty($items)) {
            return $items;
        }

        $args = [];
        foreach ($orders as $key => $val) {
            $args[] = array_column($items, $key);
            $args[] = strtolower($val) === 'desc' ? SORT_DESC : SORT_ASC;
        }
        $args[] = &$items;

        array_multisort(...$args);

        return $this->slice($items);
    }

    /**
     * @param array $items
     * @return array
     */
    private function slice(array $items): array
    {
        if (is_null($this->limit) && is_null($this->offset)) {
            return $items;
        }
        $offset = is_null($this->offset) ? 0 : $this->offset;
        return array_slice($items, $offset, $this->limit);
    }

    /**
     * @param array $items
     * @return array
     */
    private function filterItems(array $items): array
    {
        if (empty($this->select)) {
            return $items;
        }
        return array_map(function ($it) {
            return array_intersect_key($it, $this->select);
        }, $items);
    }

    /**
     * @param array $orders
     * @return array
     */
    private function filterOrders(array $orders): array
    {
        if (empty($orders) || empty($this->select)) {
            return $orders;
        }
        return array_intersect_key($orders, $this->select);
    }
}
