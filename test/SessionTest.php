<?php

class SessionTest extends \PHPUnit\Framework\TestCase
{
    private $_test;

    public function setUp()
    {
        $this->_test = new Session("TestSession");
    }

    public function tearDown()
    {
        $this->_test->destroy();
    }

    public function testSetGet()
    {
        $this->_test->set("key", "value");
        $var = $this->_test->get("key");
        $this->assertEquals($var, "value", "GetSet fail");
    }
}
