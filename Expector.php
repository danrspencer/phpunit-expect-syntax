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
        $mock = $this->actual;

        $mocker = $mock->expects($invokeMatcher)
                       ->method($this->functionName);

        $argMatchers = array();

        if (sizeof($args) > 0) {
            foreach ($args as $arg) {
                $argMatchers[] = new PHPUnit_Framework_Constraint_IsIdentical($arg);
            }
        }

        call_user_func_array(array($mocker, 'with'), $argMatchers);
    }

    public function toHaveBeenCalledWith()
    {
        $args = func_get_args();
        $mock = $this->actual;

        $invocationMocker = $this->getPrivateProperty($mock, '__phpunit_invocationMocker');
        $matchers = $this->getPrivateProperty($invocationMocker, 'matchers');

        $invocationMatcher = $matchers[0]->invocationMatcher;
        $invocations = $this->getPrivateProperty($invocationMatcher, 'invocations');

        $errors = array();

        foreach ($invocations as $invocation) {

            if ($invocation->methodName !== $this->functionName) {
                continue;
            }

            try {
                $parameters = $invocation->parameters;
                $this->testArgs($parameters, $args);
            } catch (\Exception $ex) {
                $errors[] = $ex;
            }
        }

        if (sizeof($errors) === sizeof($invocations)) {
            throw $errors[0];
        }
    }

    private function testArgs($parameters, $args)
    {
        foreach($args as $key => $value) {
            if ($value instanceof PHPUnit_Framework_Constraint) {
                $constraint = $value;
            } else {
                $constraint = new PHPUnit_Framework_Constraint_IsIdentical($value);
            }

            $constraint->evaluate($parameters[$key]);
        }
    }

    private function getPrivateProperty($object, $propertyName)
    {
        $reflect = new ReflectionClass($object);
        $property = $reflect->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
