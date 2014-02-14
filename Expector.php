<?php

class Expector
{
    private $_value;

    private $_message;

    function __construct($value, $message = '')
    {
        $this->_value = $value;
        $this->_message = $message;
    }

    public function arrayToHaveKey(array $array)
    {
        \PHPUnit_Framework_Assert::assertArrayHasKey($this->_value, $array);
    }

    public function arrayToNotHaveKey(array $array)
    {
        \PHPUnit_Framework_Assert::assertArrayNotHasKey($this->_value, $array);
    }

    public function toEqual($expected)
    {
        \PHPUnit_Framework_Assert::assertEquals($expected, $this->_value);
    }

    public function toHaveAttribute($attributeName)
    {
        \PHPUnit_Framework_Assert::assertObjectHasAttribute($attributeName, $this->_value);
    }

    public function toBeTrue()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->_value);
    }

    public function toBeFalse()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->_value);
    }

    public function toMatch($regex)
    {
        \PHPUnit_Framework_Assert::assertRegExp($regex, $this->_value);
    }

    public function toContain($needle)
    {
        \PHPUnit_Framework_Assert::assertContains($needle, $this->_value);
    }

    public function toBeInstanceOf($expected)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf($expected, $this->_value);
    }

    // -- functions for Mocks --
    public function toBeCalled(PHPUnit_Framework_MockObject_Matcher_InvokedCount $invokeMatcher = null)
    {
        $invokeMatcher = $invokeMatcher ?: new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce();

        $this->actual->expects($invokeMatcher)
                     ->method($this->functionName);
    }
}
