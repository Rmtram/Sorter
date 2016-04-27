[![Build Status](https://travis-ci.org/Rmtram/Sorter.svg)](https://travis-ci.org/Rmtram/Sorter)
[![Total
Downloads](https://poser.pugx.org/rmtram/sorter/downloads)](https://packagist.org/packages/rmtram/sorter)
[![Latest Stable
Version](https://poser.pugx.org/rmtram/sorter/v/stable.png)](https://packagist.org/packages/rmtram/sorter)

## Sorter

Simple sort of multiple arrays.


## Install

```
$ composer require rmtram/sorter
```

OR

[Source Download](https://github.com/Rmtram/Sorter/archive/v1.0.0.zip)

Copy file => `src/Sorter.php`

```
require '/path/to/Sorter.php';
```

## Usage

- Methods
    - make(array $items)
    - sort(array $option)
    - refuse(int|string|array $key)
    - limit(int|null $int = null)
    - offset(int|null $int = null)
    

#### make(array $items)

- Create instance.

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$sorter = \Rmtram\Sorter\Sorter::make($items);

```

#### sort(array $option)

- Single option. (id => asc)

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = \Rmtram\Sorter\Sorter::make($items)->sort(['id' => 'asc']);

var_dump($results);

// result
array(4) {
  [0]=>
  array(3) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "abc"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:01"
  }
  [1]=>
  array(3) {
    ["id"]=>
    int(2)
    ["name"]=>
    string(3) "def"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:05"
  }
  [2]=>
  array(3) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(3) "ghi"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:09"
  }
  [3]=>
  array(3) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(3) "mno"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:39"
  }
}
```

- Multiple option.

```php
$items = [
    ['id' => 1, 'name' => 'b', 'age' =>  9, 'created_at' => '2015-10-10 10:10:00'],
    ['id' => 2, 'name' => 'a', 'age' =>  9, 'created_at' => '2015-10-10 10:10:10'],
    ['id' => 3, 'name' => 'z', 'age' =>  3, 'created_at' => '2015-10-10 10:10:20'],
    ['id' => 5, 'name' => 'f', 'age' => 11, 'created_at' => '2015-10-10 10:10:15'],
    ['id' => 4, 'name' => 'e', 'age' => 16, 'created_at' => '2015-10-10 10:10:20'],
    ['id' => 6, 'name' => 'o', 'age' => 15, 'created_at' => '2015-10-10 10:10:05']
];

$results = \Rmtram\Sorter\Sorter::make($items)->sort([
    'age'        => 'asc',
    'created_at' => 'asc',
    'id'         => 'desc'
]);

var_dump($results);

// result
array(6) {
  [0]=>
  array(4) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(1) "z"
    ["age"]=>
    int(3)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:20"
  }
  [1]=>
  array(4) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(1) "b"
    ["age"]=>
    int(9)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:00"
  }
  [2]=>
  array(4) {
    ["id"]=>
    int(2)
    ["name"]=>
    string(1) "a"
    ["age"]=>
    int(9)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:10"
  }
  [3]=>
  array(4) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(1) "f"
    ["age"]=>
    int(11)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:15"
  }
  [4]=>
  array(4) {
    ["id"]=>
    int(6)
    ["name"]=>
    string(1) "o"
    ["age"]=>
    int(15)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:05"
  }
  [5]=>
  array(4) {
    ["id"]=>
    int(4)
    ["name"]=>
    string(1) "e"
    ["age"]=>
    int(16)
    ["created_at"]=>
    string(19) "2015-10-10 10:10:20"
  }
}
```

#### refuse(int|string|array $key)

- String

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = \Rmtram\Sorter\Sorter::make($items)->refuse('age')->sort(['id' => 'asc']);

var_dump($results);

// result
array(4) {
  [0]=>
  array(3) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "abc"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:01"
  }
  [1]=>
  array(3) {
    ["id"]=>
    int(2)
    ["name"]=>
    string(3) "def"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:05"
  }
  [2]=>
  array(3) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(3) "ghi"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:09"
  }
  [3]=>
  array(3) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(3) "mno"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:39"
  }
}

```

- Array

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = \Rmtram\Sorter\Sorter::make($items)
    ->refuse(['age', 'created_at'])
    ->sort(['id' => 'asc']);

var_dump($results);

// result
array(4) {
  [0]=>
  array(2) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "abc"
  }
  [1]=>
  array(2) {
    ["id"]=>
    int(2)
    ["name"]=>
    string(3) "def"
  }
  [2]=>
  array(2) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(3) "ghi"
  }
  [3]=>
  array(2) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(3) "mno"
  }
}
```

#### limit(int|null $int = null)

`No limit in the case of null`

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = \Rmtram\Sorter\Sorter::make($items)
    ->limit(1)
    ->sort(['id' => 'asc']);

var_dump($results);

// result
array(1) {
  [0]=>
  array(3) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "abc"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:01"
  }
}
```

#### offset(int|null $int = null)

`Offset null === offset 0`

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = \Rmtram\Sorter\Sorter::make($items)
    ->offset(3)
    ->sort(['id' => 'asc']);

var_dump($results);

// result
array(2) {
  [0]=>
  array(3) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(3) "ghi"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:09"
  }
  [1]=>
  array(3) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(3) "mno"
    ["created_at"]=>
    string(19) "2015-10-14 10:10:39"
  }
}
```

## Support versions.

- PHP
    - 5.4
    - 5.5
    - 5.6
    - 7.0
- HHVM

## LICENSE

The MIT License (MIT)

Copyright (c) 2016 Rmtram

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
