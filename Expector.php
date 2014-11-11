<?php

class Expector
{
    private $actual;
    private $message;

    function __construct($actual, $message = '')
    {
        $this->actual = $actual;
        $this->message = $message;
    }

    public function arrayToHaveKey($key)
    {
        \PHPUnit_Framework_Assert::assertArrayHasKey($key, $this->actual);
    }

    public function arrayToNotHaveKey($key)
    {
        \PHPUnit_Framework_Assert::assertArrayNotHasKey($key, $this->actual);
    }

    public function toEqual($expected)
    {
        \PHPUnit_Framework_Assert::assertEquals($expected, $this->actual);
    }
    
    public function toNotEqual($expected)
    {
        \PHPUnit_Framework_Assert::assertNotEquals($expected, $this->actual);
    }

    public function toHaveAttribute($attributeName)
    {
        \PHPUnit_Framework_Assert::assertObjectHasAttribute($attributeName, $this->actual);
    }
    
    public function toNotHaveAttribute($attributeName)
    {
        \PHPUnit_Framework_Assert::assertObjectNotHasAttribute($attributeName, $this->actual);
    }

    public function toBeTrue()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->actual);
    }

    public function toBeFalse()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->actual);
    }

    public function toMatch($regex)
    {
        \PHPUnit_Framework_Assert::assertRegExp($regex, $this->actual);
    }

    public function toContain($needle)
    {
        \PHPUnit_Framework_Assert::assertContains($needle, $this->actual);
    }
    
    public function toBe($expected)
    {
        \PHPUnit_Framework_Assert::assertSame($expected, $this->actual);
    }

    public function toBeInstanceOf($expected)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf($expected, $this->actual);
    }
    
    public function classToHaveAttribute($attributeName)
    {
        \PHPUnit_Framework_Assert::assertClassHasAttribute($attributeName, $this->actual);
    }

    public function toBeGreaterThan($expected)
    {
        \PHPUnit_Framework_Assert::assertGreaterThan($expected, $this->actual);
    }
    
    public function toBeLessThan($expected)
    {
        \PHPUnit_Framework_Assert::assertLessThan($expected, $this->actual);
    }
}
