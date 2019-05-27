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
    public function start()
    {
        if (!empty(session_id())) {
            session_destroy();
        }
        session_name($this->name);
        session_start();
    }

    /**
     * [has description]
     *
     * @param string $key [description]
     *
     * @return boolean      [description]
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * [set description]
     *
     * @param string $key [description]
     * @param string $val [description]
     *
     * @return void
     */
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    /**
     * [get description]
     *
     * @param string  $key     [description]
     * @param boolean $default [description]
     *
     * @return mixed           [description]
     */
    public function get($key, $default = false)
    {
        return ($this->has($key)) ? $_SESSION[$key] : $default;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Undocumented function
     *
     * @param string $key [description]
     *
     * @return void
     */
    public function delete($key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function dump()
    {
        return "<pre>" . print_r($_SESSION, 1) . "</pre>";
    }
}
