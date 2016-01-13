phpunit-expect-syntax
==============

A wrapper for PHPUnit which allows expect assertion syntax inspired by JavaScript's Jasmine.

**Note: currently incomplete - if I'm missing a matcher you need create an issue or pull request**

## Installation

### Step 1. Install via Composer

The preferred way to install this bundle is via Composer. Just add it to your composer.json:

``` js
{
    "require": {
        // ...
        "danrspencer/phpunit-expect-syntax": "1.0.0"
    }
}
``` 

### Step 2. Include the expect-syntax.php file

To begin using the syntax you'll need to include the expect-syntax.php file. This can be done in your PHPUnit bootstrap (recommended) or in invididual tests.

e.g.

``` php
require_once '../vendor/danrspencer/phpunit-expect-syntax/ExpectSyntax.php';
```

## Example usage

``` php
/** @test */
function it_tests_something() {
	expect($this)->toEqual($that);	
}
```
