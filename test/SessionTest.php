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
    protected function setUp() : void
    {
        $this->_test = new Session("TestSession");
    }

    /**
     * This method is called after each test
     *
     * @return void
     */
    protected function tearDown() : void
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

    /**
     * Testing Delete()
     *
     * @return void
     */
    public function testDelete()
    {
        $this->_test->set("key", "value");
        $res = $this->_test->has("key");
        $this->assertTrue($res, "Key not found");
        $this->_test->delete("key");
        $res = $this->_test->has("key");
        $this->assertFalse($res, "Key still found");
    }

    /**
     * Testing dump()
     *
     * @return void
     */
    public function testDump()
    {
        $this->_test->set("key", "value");
        $res = $this->_test->dump();
        $this->assertEquals($res, "<pre>Array\n(\n    [key] => value\n)\n</pre>", "Dump is not working");
    }

    /**
     * Testing to start again
     *
     * @return void
     */
    public function testStartAgain()
    {
        $this->_test->start();
        $this->_test->set("key", "value");
        $res = $this->_test->has("key");
        $this->assertTrue($res, "Key not found");
    }
}
