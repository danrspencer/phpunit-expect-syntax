<?php

class Expector
{
    private $actual;
    private $functionName;

    private $message;

    function __construct($actual, $functionName = null, $message = '')
    {
        $this->actual = $actual;
        $this->functionName = $functionName;

        $this->message = $message;
    }

    public function arrayToHaveKey(array $array)
    {
        \PHPUnit_Framework_Assert::assertArrayHasKey($this->actual, $array);
    }

    public function arrayToNotHaveKey(array $array)
    {
        \PHPUnit_Framework_Assert::assertArrayNotHasKey($this->actual, $array);
    }

    public function toEqual($expected)
    {
        \PHPUnit_Framework_Assert::assertEquals($expected, $this->actual);
    }

    public function toHaveAttribute($attributeName)
    {
        \PHPUnit_Framework_Assert::assertObjectHasAttribute($attributeName, $this->actual);
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

    public function toBeInstanceOf($expected)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf($expected, $this->actual);
    }

    public function toBeCalled(PHPUnit_Framework_MockObject_Matcher_InvokedCount $invokeMatcher = null)
    {
        $invokeMatcher = $invokeMatcher ?: new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce();

        $this->actual->expects($invokeMatcher)
                     ->method($this->functionName);
    }
    
    public function toBeCalledWith()
    {
        $invokeMatcher = new PHPUnit_Framework_MockObject_Matcher_InvokedAtLeastOnce();
        $args = func_get_args();

        $mocker = $this->actual->expects($invokeMatcher)
                               ->method($this->functionName);

        call_user_func_array([$mocker, 'with'], $args);
    }
}
