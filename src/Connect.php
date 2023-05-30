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
    public function addUser($user, $name, $pass) : void
    {
        $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT into users (user, name, pass) VALUES ('$user', '$name', '$crypt_pass')");
        $stmt->execute();
    }

    /**
     * Delete a user
     *
     * @param string $user User ID
     *
     * @return void
     */
    public function deleteUser($user) : void
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user='$user'");
        $stmt->execute();
    }

    /**
     * Get the hash
     *
     * @param string $user User ID
     *
     * @return string Hash
     */
    public function getHash($user) : string
    {
        $stmt = $this->db->prepare("SELECT pass FROM users WHERE user='$user'");
        $stmt->execute();
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $res["pass"];
    }

    /**
     * Change password
     *
     * @param string $user User ID
     * @param string $pass User Password
     *
     * @return void
     */
    public function changePassword($user, $pass) : void
    {
        $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET pass='$crypt_pass' WHERE user='$user'");
        $stmt->execute();
    }

    /**
     * Check if user exists
     *
     * @param string $user User ID
     *
     * @return bool True if user exists, otherwise false
     */
    public function exists($user) : bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user='$user'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return !$row ? false : true;
    }

    /**
     * Verify user
     *
     * @param string $user User ID
     * @param string $pass User Password
     *
     * @return bool True if user exists, otherwise false
     */
    public function verifyUser($user, $pass) : bool
    {
        $crypt_pass = $this->getHash($user);
        $verified = password_verify($pass, $crypt_pass);
        return $verified;
    }
}
