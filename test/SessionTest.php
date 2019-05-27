<?php

use \PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    /**
     * The Test object
     *
     * @var mixed $_test The test object
     */
    private $_test;

    /**
     * This method is called before each test
     *
     * @return void
     */
    public function setUp()
    {
        $this->_test = new Session("TestSession");
    }

    /**
     * This method is called after each test
     *
     * @return void
     */
    public function tearDown()
    {
        $this->_test->destroy();
    }

    /**
     * Testing Set() and Get()
     *
     * @return void
     */
    public function testSetGet()
    {
        $this->_test->set("key", "value");
        $var = $this->_test->get("key");
        $this->assertEquals($var, "value", "GetSet fail");
    }
}
