phpunit-expect-syntax
==============

A wrapper for PHPUnit which allows expect assertion syntax inspired by JavaScript's Jasmine.

## Installation

### Step 1. Install via Composer

The preferred way to install this bundle is to rely on Composer. Just add it to your composer.json:

``` js
{
    "require": {
        // ...
        "danrspencer/phpunit-expect-syntax": "dev-master"
    }
}
``` 

### Step 2. Include the expect-syntax.php file

To begin using the syntax you'll need to load in the expect-syntax.php file. This can be done in your PHPUnit bootstrap (recommended) or in invididual tests.

e.g.

``` php
require_once '../vendor/danrspencer/phpunit-expect-syntax/ExpectSyntax.php';
```

## Example usage

``` php
/** @test */
function it_tests_something() {
	expect('this')->toEqual('this');	
}

/** @test */
function it_delegates_to_a_mock() {
	expect($mock, 'function')->toBeCalled();
}
```

Expect Syntax also adds improved syntax for controlling mocks:

``` php
/** @test */
function it_delegates_to_a_mock() {
	setMock($mock, 'function')->toReturn('value');
}
```
