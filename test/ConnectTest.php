<?php

class ConnectTest extends \PHPUnit\Framework\TestCase
{
    private $_test;

    public function setUp()
    {
        $fileName = __DIR__ . "/../db/users.sqlite";
        $this->_test = new Connect("sqlite:$fileName");
    }

    public function tearDown()
    {
        $this->_test->deleteUser("user");
    }

    public function testAddUser()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, true, "AddUser failed");
        $var = $this->_test->exists("person");
        $this->assertEquals($var, false, "Negative AddUser failed");
    }

    public function testDeleteUser()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, true, "AddUser failed");
        $this->_test->deleteUser("user");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, false, "DeleteUser failed");
    }

    public function testGetHash()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->getHash("user");
        $this->assertNotEquals($var, "pass", "Hash and password equal");
    }
}
