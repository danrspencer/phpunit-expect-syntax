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
        \PHPUnit\Framework\Assert::assertArrayHasKey($key, $this->actual);
    }

    public function arrayToNotHaveKey($key)
    {
        \PHPUnit\Framework\Assert::assertArrayNotHasKey($key, $this->actual);
    }

    public function classToHaveAttribute($attributeName)
    {
        \PHPUnit\Framework\Assert::assertClassHasAttribute($attributeName, $this->actual);
    }

    public function toBe($expected)
    {
        \PHPUnit\Framework\Assert::assertSame($expected, $this->actual);
    }

    public function toBeFalse()
    {
        \PHPUnit\Framework\Assert::assertFalse($this->actual);
    }

    public function toBeGreaterThan($expected)
    {
        \PHPUnit\Framework\Assert::assertGreaterThan($expected, $this->actual);
    }

    public function toBeInstanceOf($expected)
    {
        \PHPUnit\Framework\Assert::assertInstanceOf($expected, $this->actual);
    }

    public function toBeLessThan($expected)
    {
        \PHPUnit\Framework\Assert::assertLessThan($expected, $this->actual);
    }

    public function toBeTrue()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->actual);
    }

    public function toContain($needle)
    {
        \PHPUnit\Framework\Assert::assertContains($needle, $this->actual);
    }

    public function toContainAll(array $expected)
    {
        \PHPUnit\Framework\Assert::assertEquals($expected, $this->actual, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }

    public function toEqual($expected)
    {
        \PHPUnit\Framework\Assert::assertEquals($expected, $this->actual);
    }

    public function toHaveAttribute($attributeName)
    {
        \PHPUnit\Framework\Assert::assertObjectHasAttribute($attributeName, $this->actual);
    }

    public function toMatch($regex)
    {
        \PHPUnit\Framework\Assert::assertRegExp($regex, $this->actual);
    }

    public function toNotEqual($expected)
    {
        \PHPUnit\Framework\Assert::assertNotEquals($expected, $this->actual);
    }

    public function toNotHaveAttribute($attributeName)
    {
        \PHPUnit\Framework\Assert::assertObjectNotHasAttribute($attributeName, $this->actual);
    }
}
