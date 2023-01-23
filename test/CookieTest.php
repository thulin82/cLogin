<?php

use \PHPUnit\Framework\TestCase;

class CookieTest extends TestCase
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
        $this->_test = new Cookie(200, "CLI");
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
    public function testSetGetCookie()
    {
        $this->_test->set("key", "value");
        $res = $this->_test->get("key");
        $this->assertEquals($res, "value", "GetSetCookie failed");
        $res2 = $this->_test->get("wrongKey");
        $this->assertEquals($res2, false, "Negative GetSetCookie failed");
    }

    /**
     * Testing Has()
     *
     * @return void
     */
    public function testHas()
    {
        $this->_test->set("key", "value");
        $res = $this->_test->has("key");
        $this->assertTrue($res, "Key not found");
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
        $this->assertEquals($res, "<pre>Array\n(\n    [key] =&gt; value\n)\n</pre>", "Dump is not working");
    }
}
