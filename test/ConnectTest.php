<?php

use \PHPUnit\Framework\TestCase;

class ConnectTest extends TestCase
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
        $fileName = __DIR__ . "/../db/users.sqlite";
        $this->_test = new Connect("sqlite:$fileName");
    }

    /**
     * This method is called after each test
     *
     * @return void
     */
    protected function tearDown() : void
    {
        $this->_test->deleteUser("user");
    }

    /**
     * Testing addUser()
     *
     * @return void
     */
    public function testAddUser()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, true, "AddUser failed");
        $var = $this->_test->exists("person");
        $this->assertEquals($var, false, "Negative AddUser failed");
    }

    /**
     * Testing deleteUser()
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, true, "AddUser failed");
        $this->_test->deleteUser("user");
        $var = $this->_test->exists("user");
        $this->assertEquals($var, false, "DeleteUser failed");
    }

    /**
     * Testing getHash()
     *
     * @return void
     */
    public function testGetHash()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->getHash("user");
        $this->assertNotEquals($var, "pass", "Hash and password equal");
    }

    /**
     * Testing changePassword()
     *
     * @return void
     */
    public function testChangePassword()
    {
        $this->_test->addUser("user", "name", "pass");
        $var = $this->_test->verifyUser("user", "pass");
        $this->assertEquals($var, true, "AddUser failed");

        $this->_test->changePassword("user", "pass2");

        $var = $this->_test->verifyUser("user", "pass");
        $this->assertEquals($var, false, "ChangePassword failed");
        $var = $this->_test->verifyUser("user", "pass2");
        $this->assertEquals($var, true, "ChangePassword failed");
    }

    /**
     * Testing Exception in constructor
     *
     * @expectedException PDOException
     *
     * @return void
     */
    public function testMissingDSN()
    {
        $this->expectException(PDOException::class);
        $this->_test2 = new Connect("testytest");
    }
}
