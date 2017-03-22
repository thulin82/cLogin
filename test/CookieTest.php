<?php

class CookieTest extends \PHPUnit\Framework\TestCase
{
    private $_test;

    public function setUp()
    {
        $this->_test = new Cookie(200, "CLI");
    }

    public function tearDown()
    {
        $this->_test->destroy();
    }

    public function testSetGetCookie()
    {
        $this->_test->set("key", "value");
        $res = $this->_test->get("key");
        $this->assertEquals($res, "value", "GetSetCookie failed");
        $res2 = $this->_test->get("wrongKey");
        $this->assertEquals($res2, false, "Negative GetSetCookie failed");
    }
}
