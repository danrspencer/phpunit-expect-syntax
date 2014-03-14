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
        $stub = new PHPUnit_Framework_MockObject_Stub_Return($value);

        $this->trainMock($stub);
    }

    function toCallFake($callback)
    {
        $stub = new PHPUnit_Framework_MockObject_Stub_ReturnCallback($callback);

        $this->trainMock($stub);
    }


    function toSpy()
    {
        $matcher = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount();

        $this->mock->expects($matcher)
                   ->method($this->functionName);
    }

    private function trainMock($stub)
    {
        if ($this->overwriteExistingStub($stub) === false) {
            $matcher = new PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount();

            $this->mock->expects($matcher)
                        ->method($this->functionName)
                        ->will($stub);
        }
    }

    private function overwriteExistingStub($stub)
    {
        $invocationMocker = $this->getPrivateProperty($this->mock, '__phpunit_invocationMocker');

        if ($invocationMocker === null) {
            return false;
        }

        $matchers = $this->getPrivateProperty($invocationMocker, 'matchers');

        foreach ($matchers as $matcher) {
            $methodNameMatcher = $matcher->methodNameMatcher;
            $constraint = $this->getPrivateProperty($methodNameMatcher, 'constraint');
            $methodName = $this->getPrivateProperty($constraint, 'value');

            if ($methodName === $this->functionName) {
                $matcher->stub = $stub;

                return true;
            }
        }

        return false;
    }

    private function getPrivateProperty($object, $propertyName)
    {
        $reflect = new ReflectionClass($object);
        $property = $reflect->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
} 
