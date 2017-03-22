<?php

class Connect
{
    private $db;

    /**
     * [__construct description]
     *
     * @param [type] $dsn [description]
     */
    public function __construct($dsn)
    {
        try {
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        } catch (PDOException $e) {
            echo "Failed to connect to the database using DSN:<br>$dsn<br>";
        }
    }

    /**
     * [addUser description]
     *
     * @param [type] $user [description]
     * @param [type] $name [description]
     * @param [type] $pass [description]
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
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function deleteUser($user)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user='$user'");
        $stmt->execute();
    }

    /**
     * [getHash description]
     *
     * @param  [type] $user [description]
     * @return [type]       [description]
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
     * @param  [type] $user [description]
     * @param  [type] $pass [description]
     * @return [type]       [description]
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
     * @param  [type] $user [description]
     * @return [type]       [description]
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
     * @param  [type] $user [description]
     * @param  [type] $pass [description]
     * @return [type]       [description]
     */
    public function verifyUser($user, $pass)
    {
        $crypt_pass = self::getHash($user);
        $verified = password_verify($pass, $crypt_pass);
        return $verified;
    }
}
