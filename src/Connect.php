<?php

class Connect
{
    /**
     * The PDO object
     *
     * @var mixed $db PDO object
     */
    private $db;

    /**
     * Constructor
     *
     * @param string $dsn DSN
     */
    public function __construct($dsn)
    {
        try {
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        } catch (Exception $e) {
            throw new PDOException("Failed to connect to the database using DSN:<br>$dsn<br>");
        }
    }

    /**
     * Add a user
     *
     * @param string $user User ID
     * @param string $name User Name
     * @param string $pass User Password
     *
     * @return void
     */
    public function addUser($user, $name, $pass)
    {
        $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT into users (user, name, pass) VALUES ('$user', '$name', '$crypt_pass')");
        $stmt->execute();
    }

    /**
     * [deleteUser description]
     *
     * @param string $user [description]
     *
     * @return void
     */
    public function deleteUser($user)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user='$user'");
        $stmt->execute();
    }

    /**
     * [getHash description]
     *
     * @param string $user [description]
     *
     * @return string       [description]
     */
    public function getHash($user)
    {
        $stmt = $this->db->prepare("SELECT pass FROM users WHERE user='$user'");
        $stmt->execute();
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $res["pass"];
    }

    /**
     * [changePassword description]
     *
     * @param string $user [description]
     * @param string $pass [description]
     *
     * @return void
     */
    public function changePassword($user, $pass)
    {
        $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET pass='$crypt_pass' WHERE user='$user'");
        $stmt->execute();
    }

    /**
     * [exists description]
     *
     * @param string $user [description]
     *
     * @return bool [description]
     */
    public function exists($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user='$user'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return !$row ? false : true;
    }

    /**
     * [verifyUser description]
     *
     * @param string $user [description]
     * @param string $pass [description]
     *
     * @return bool [description]
     */
    public function verifyUser($user, $pass)
    {
        $crypt_pass = $this->getHash($user);
        $verified = password_verify($pass, $crypt_pass);
        return $verified;
    }
}
