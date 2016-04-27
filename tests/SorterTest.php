<?php

namespace Rmtram\Sorter\TestCase;

use Rmtram\Sorter\Sorter;

/**
 * Class SorterTest
 * @package Rmtram\Sorter\TestCase
 */
class SorterTest extends \PHPUnit_Framework_TestCase
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

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testIntegerAsc()
    {
        $items = Sorter::make($this->items)
            ->sort(['id' => 'asc']);
        $this->assertEquals(1, $items[0]['id']);
        $this->assertEquals(2, $items[1]['id']);
        $this->assertEquals(3, $items[2]['id']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testIntegerDesc()
    {
        $items = Sorter::make($this->items)
            ->sort(['id' => 'desc']);
        $this->assertEquals(3, $items[0]['id']);
        $this->assertEquals(2, $items[1]['id']);
        $this->assertEquals(1, $items[2]['id']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testStringAsc()
    {
        $items = Sorter::make($this->items)
            ->sort(['name' => 'asc']);
        $this->assertEquals('abc', $items[0]['name']);
        $this->assertEquals('bca', $items[1]['name']);
        $this->assertEquals('cba', $items[2]['name']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testStringDesc()
    {
        $items = Sorter::make($this->items)
            ->sort(['name' => 'desc']);
        $this->assertEquals('cba', $items[0]['name']);
        $this->assertEquals('bca', $items[1]['name']);
        $this->assertEquals('abc', $items[2]['name']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testDateAsc()
    {
        $items = Sorter::make($this->items)
            ->sort(['created' => 'asc']);
        $this->assertEquals('2012-10-14', $items[0]['created']);
        $this->assertEquals('2015-10-14', $items[1]['created']);
        $this->assertEquals('2015-10-15', $items[2]['created']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testDateDesc()
    {
        $items = Sorter::make($this->items)
            ->sort(['created' => 'desc']);
        $this->assertEquals('2015-10-15', $items[0]['created']);
        $this->assertEquals('2015-10-14', $items[1]['created']);
        $this->assertEquals('2012-10-14', $items[2]['created']);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testRefuseWithString()
    {
        $items = Sorter::make($this->items)
            ->refuse('name')
            ->sort(['id' => 'desc']);
        $this->assertArrayNotHasKey('name', $items[0]);
        $this->assertArrayNotHasKey('name', $items[1]);
        $this->assertArrayNotHasKey('name', $items[2]);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testRefuseWithArray()
    {
        $items = Sorter::make($this->items)
            ->refuse(['name', 'age'])
            ->sort(['id' => 'desc']);
        $this->assertArrayNotHasKey('name', $items[0]);
        $this->assertArrayNotHasKey('name', $items[1]);
        $this->assertArrayNotHasKey('name', $items[2]);
        $this->assertArrayNotHasKey('age', $items[0]);
        $this->assertArrayNotHasKey('age', $items[1]);
        $this->assertArrayNotHasKey('age', $items[2]);
    }

    /**
     * Do not sort.
     * @covers Sorter::make
     * @covers Sorter::sort
     */
    public function testMatchRefuseKeyAndSortKey()
    {
        $items = Sorter::make($this->items)
            ->refuse('id')
            ->sort(['id' => 'desc']);
        $this->assertEquals('abc', $items[0]['name']);
        $this->assertEquals('bca', $items[1]['name']);
        $this->assertEquals('cba', $items[2]['name']);
        $this->assertArrayNotHasKey('id', $items[0]);
        $this->assertArrayNotHasKey('id', $items[1]);
        $this->assertArrayNotHasKey('id', $items[2]);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::limit
     * @covers Sorter::sort
     */
    public function testLimit()
    {
        $items = Sorter::make($this->items)
            ->limit(1)
            ->sort(['id' => 'asc']);
        $this->assertCount(1, $items);
    }

    /**
     * @covers Sorter::make
     * @covers Sorter::limit
     * @covers Sorter::sort
     */
    public function testOffset()
    {
        $items = Sorter::make($this->items)
            ->limit(2)
            ->offset(2)
            ->sort(['id' => 'asc']);
        $this->assertEquals(2, $items[0]['id']);
        $this->assertEquals(3, $items[1]['id']);
    }
}
