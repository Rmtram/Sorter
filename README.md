[![Build Status](https://travis-ci.org/Rmtram/Sorter.svg)](https://travis-ci.org/Rmtram/Sorter)
[![Latest Stable
Version](https://poser.pugx.org/rmtram/sorter/v/stable.png)](https://packagist.org/packages/rmtram/sorter)
[![Total
Downloads](https://poser.pugx.org/rmtram/sorter/downloads)](https://packagist.org/packages/rmtram/sorter)
[![License](https://poser.pugx.org/rmtram/sorter/license)](https://packagist.org/packages/rmtram/sorter)

# Sorter

Simple sort of multiple arrays.


# Install

```
$ composer require rmtram/sorter
```

OR

[Source Download](https://github.com/Rmtram/Sorter/archive/v2.0.0.zip)

Copy file: `src/Sorter.php`

```
require '/path/to/Sorter.php';
```

# Contents

- [static] [make(array $items)](#make)
- [static] [runSort(array $items, array $orders, $select = [], $offset = null, $limit = null)](#runSort)
- [sort(array $orders)](#sort)
- [select(array $attributes)](#select)
- [offset(int|null $int = null)](#offset)
- [limit(int|null $int = null)](#limit)

# Methods

## make

- Create instance.

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$sorter = Rmtram\Sorter\Sorter::make($items);

```

## runSort

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = Rmtram\Sorter\Sorter::runSort($items, ['id' => 'asc'], ['id'], 1, 1);

var_dump($results);
```

- Result

```
array(1) {
  [0]=>
  array(1) {
    ["id"]=>
    int(2)
  }
}
```

## sort

### Single (id => asc)

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = Rmtram\Sorter\Sorter::make($items)->sort(['id' => 'asc']);

var_dump($results);
```

- Result

```
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

### Multiple

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'b', 'age' =>  9, 'created_at' => '2015-10-10 10:10:00'],
    ['id' => 2, 'name' => 'a', 'age' =>  9, 'created_at' => '2015-10-10 10:10:10'],
    ['id' => 3, 'name' => 'z', 'age' =>  3, 'created_at' => '2015-10-10 10:10:20'],
    ['id' => 5, 'name' => 'f', 'age' => 11, 'created_at' => '2015-10-10 10:10:15'],
    ['id' => 4, 'name' => 'e', 'age' => 16, 'created_at' => '2015-10-10 10:10:20'],
    ['id' => 6, 'name' => 'o', 'age' => 15, 'created_at' => '2015-10-10 10:10:05']
];

$results = Rmtram\Sorter\Sorter::make($items)->sort([
    'age'        => 'asc',
    'created_at' => 'asc',
    'id'         => 'desc'
]);

var_dump($results);
```

- Result

```
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

## select

### Single

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = Rmtram\Sorter\Sorter::make($items)->refuse('age')->sort(['id' => 'asc']);

var_dump($results);
```

- Result

```
array(4) {
  [0]=>
  array(1) {
    ["id"]=>
    int(1)
  }
  [1]=>
  array(1) {
    ["id"]=>
    int(2)
  }
  [2]=>
  array(1) {
    ["id"]=>
    int(3)
  }
  [3]=>
  array(1) {
    ["id"]=>
    int(5)
  }
}
```

### Multiple

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 1, 'name' => 'bac', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$sortedItems = Rmtram\Sorter\Sorter::make($items)->select(['id', 'name'])->sort(['id' => 'asc', 'name' => 'desc']);

var_dump($sortedItems);
```

- Result

```
array(5) {
  [0]=>
  array(2) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "bac"
  }
  [1]=>
  array(2) {
    ["id"]=>
    int(1)
    ["name"]=>
    string(3) "abc"
  }
  [2]=>
  array(2) {
    ["id"]=>
    int(2)
    ["name"]=>
    string(3) "def"
  }
  [3]=>
  array(2) {
    ["id"]=>
    int(3)
    ["name"]=>
    string(3) "ghi"
  }
  [4]=>
  array(2) {
    ["id"]=>
    int(5)
    ["name"]=>
    string(3) "mno"
  }
}
```

## offset

`Offset null === offset 0`

**!!! Important !!!**

Changed offset implementation.

> Before

```
offset(0) => 0
offset(1) => 0
offset(2) => 1
offset(3) => 2
```

> After

```
offset(0) => 0
offset(1) => 1
offset(2) => 2
offset(3) => 3
```

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = Rmtram\Sorter\Sorter::make($items)
    ->offset(3)
    ->sort(['id' => 'asc']);

var_dump($results);
```

- Result

```
array(1) {
  [0]=>
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

## limit

`No limit in the case of null`

- Source code

```php
$items = [
    ['id' => 1, 'name' => 'abc', 'created_at' => '2015-10-14 10:10:01'],
    ['id' => 2, 'name' => 'def', 'created_at' => '2015-10-14 10:10:05'],
    ['id' => 5, 'name' => 'mno', 'created_at' => '2015-10-14 10:10:39'],
    ['id' => 3, 'name' => 'ghi', 'created_at' => '2015-10-14 10:10:09']
];

$results = Rmtram\Sorter\Sorter::make($items)
    ->limit(1)
    ->sort(['id' => 'asc']);

var_dump($results);
```

- Result

```
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

# Support versions.

- PHP
    - 7.2
    - 7.3
    - 7.4

# LICENSE

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
