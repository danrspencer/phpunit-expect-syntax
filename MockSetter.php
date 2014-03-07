<?php


class MockSetter {

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $mock;
    private $functionName;

    function __construct(PHPUnit_Framework_MockObject_MockObject $mock, $functionName)
    {
        $this->mock = $mock;
        $this->functionName = $functionName;
    }

    function toReturn($value)
    {
        $matcher = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount();
        $stub = new PHPUnit_Framework_MockObject_Stub_Return($value);

        $this->mock->expects($matcher)
                   ->method($this->functionName)
                   ->will($stub);
    }

    function toSpy()
    {
        $matcher = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount();

        $this->mock->expects($matcher);
    }
} 
