<?php

class Session
{
    private $name;

    /**
     * [__construct description]
     *
     * @param string string [description]
     */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
        $this->start();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function start()
    {
        session_name($this->name);

        if (!empty(session_id())) {
            session_destroy();
        }
        session_start();
    }

    /**
     * [has description]
     *
     * @param  string  $key [description]
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
     */
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    /**
     * [get description]
     *
     * @param  string  $key     [description]
     * @param  boolean $default [description]
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
     * @param  string $key
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
     * @return void
     */
    public function dump()
    {
        echo "<pre>" . print_r($_SESSION, 1) . "</pre>";
    }
}
