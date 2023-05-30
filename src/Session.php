<?php

class Session
{
    /**
     * Session name
     *
     * @var string $name Name
     */
    private $name;

    /**
     * Constructor
     *
     * @param string $name Session name
     */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
        $this->start();
    }

    /**
     * Start the session
     *
     * @return void
     */
    public function start() : void
    {
        if (!empty(session_id())) {
            session_destroy();
        }
        session_name($this->name);
        session_start();
    }

    /**
     * Check if key exists in $_SESSION
     *
     * @param string $key The key to check for
     *
     * @return bool true if it exists, otherwise false
     */
    public function has($key) : bool
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Set session variable
     *
     * @param string $key The name of the session variable
     * @param string $val The value of the session variable
     *
     * @return void
     */
    public function set($key, $val) : void
    {
        $_SESSION[$key] = $val;
    }

    /**
     * Get session variable
     *
     * @param string $key     The name of the session variable
     * @param mixed  $default The default value to return if the key is not found
     *
     * @return mixed The value of the session variable
     */
    public function get($key, $default = false) : mixed
    {
        return ($this->has($key)) ? $_SESSION[$key] : $default;
    }

    /**
     * Destroy the session
     *
     * @return void
     */
    public function destroy() : void
    {
        session_destroy();
    }

    /**
     * Delete a session variable
     *
     * @param string $key The name of the session variable
     *
     * @return void
     */
    public function delete($key) : void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Dump the session
     *
     * @return string
     */
    public function dump() : string
    {
        return "<pre>" . print_r($_SESSION, 1) . "</pre>";
    }
}
