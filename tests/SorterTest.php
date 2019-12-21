<?php

namespace Rmtram\Sorter\TestCase;

use Rmtram\Sorter\Sorter;

/**
 * Class SorterTest
 * @package Rmtram\Sorter\TestCase
 */
class SorterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array
     */
    private $items = [
        [
            'id' => 2,
            'name' => 'abc',
            'age' => 19,
            'created' => '2015-10-14'
        ],
        [
            'id' => 1,
            'name' => 'bca',
            'age' => 14,
            'created' => '2012-10-14'
        ],
        [
            'id' => 3,
            'name' => 'cba',
            'age' => 21,
            'created' => '2015-10-15'
        ]
    ];

    public function testRunSort()
    {
        $a = Sorter::make($this->items)->sort(['id' => 'asc']);
        $b = Sorter::runSort($this->items, ['id' => 'asc']);
        $this->assertEquals($a, $b);

        $a = Sorter::make($this->items)->select(['id'])->sort(['id' => 'asc']);
        $b = Sorter::runSort($this->items, ['id' => 'asc'], ['id']);
        $this->assertEquals($a, $b);

        $a = Sorter::make($this->items)->offset(1)->limit(1)->sort(['id' => 'asc']);
        $b = Sorter::runSort($this->items, ['id' => 'asc'], [], 1, 1);
        $this->assertEquals($a, $b);
    }

    public function testIntegerAsc()
    {
        $items = Sorter::make($this->items)->sort(['id' => 'asc']);
        $this->assertEquals(1, $items[0]['id']);
        $this->assertEquals(2, $items[1]['id']);
        $this->assertEquals(3, $items[2]['id']);
    }

    public function testIntegerDesc()
    {
        $items = Sorter::make($this->items)->sort(['id' => 'desc']);
        $this->assertEquals(3, $items[0]['id']);
        $this->assertEquals(2, $items[1]['id']);
        $this->assertEquals(1, $items[2]['id']);
    }

    public function testStringAsc()
    {
        $items = Sorter::make($this->items)->sort(['name' => 'asc']);
        $this->assertEquals('abc', $items[0]['name']);
        $this->assertEquals('bca', $items[1]['name']);
        $this->assertEquals('cba', $items[2]['name']);
    }

    public function testStringDesc()
    {
        $items = Sorter::make($this->items)->sort(['name' => 'desc']);
        $this->assertEquals('cba', $items[0]['name']);
        $this->assertEquals('bca', $items[1]['name']);
        $this->assertEquals('abc', $items[2]['name']);
    }

    public function testDateAsc()
    {
        $items = Sorter::make($this->items)->sort(['created' => 'asc']);
        $this->assertEquals('2012-10-14', $items[0]['created']);
        $this->assertEquals('2015-10-14', $items[1]['created']);
        $this->assertEquals('2015-10-15', $items[2]['created']);
    }

    public function testDateDesc()
    {
        $items = Sorter::make($this->items)->sort(['created' => 'desc']);
        $this->assertEquals('2015-10-15', $items[0]['created']);
        $this->assertEquals('2015-10-14', $items[1]['created']);
        $this->assertEquals('2012-10-14', $items[2]['created']);
    }

    public function testSelectForSingle()
    {
        $items = Sorter::make($this->items)->select(['id'])->sort(['id' => 'asc']);
        foreach ($items as $index => $it) {
            $this->assertArrayHasKey('id', $it);
            $this->assertCount(1, $it);
            $this->assertEquals($index + 1, $it['id']);
        }
    }

    public function testSelectForMultiple()
    {
        $ages = [14, 19, 21];
        $items = Sorter::make($this->items)->select(['name', 'age'])->sort(['age' => 'asc']);
        foreach ($items as $index => $it) {
            $this->assertArrayHasKey('name', $it);
            $this->assertArrayHasKey('age', $it);
            $this->assertCount(2, $it);
            $this->assertEquals($ages[$index], $it['age']);
        }
    }

    public function testLimit()
    {
        $items = Sorter::make($this->items)->limit(1)->sort(['id' => 'asc']);
        $this->assertCount(1, $items);
    }

    public function testOffset()
    {
        $items = Sorter::make($this->items)->limit(2)->offset(1)->sort(['id' => 'asc']);
        $this->assertEquals(2, $items[0]['id']);
        $this->assertEquals(3, $items[1]['id']);
    }
}
