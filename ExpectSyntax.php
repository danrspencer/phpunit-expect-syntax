<?php

require_once 'Expector.php';
require_once 'MockSetter.php';

function expect($actual, $functionName = null)
{
    return new Expector($actual, $functionName);
}

function setMock(\PHPUnit_Framework_MockObject_MockObject $mock, $functionName)
{
    return new MockSetter($mock, $functionName);
}