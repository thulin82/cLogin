<?php

class Session
{
    private $name;

    /**
     * [__construct description]
     *
     * @param string $name [description]
     */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
        $this->start();
    }

    /**
     * [start description]
     *
     * @return [type] [description]
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
     * @param  [type]  $key [description]
     * @return boolean      [description]
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * [set description]
     *
     * @param [type] $key [description]
     * @param [type] $val [description]
     */
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    /**
     * [get description]
     *
     * @param  [type]  $key     [description]
     * @param  boolean $default [description]
     * @return [type]           [description]
     */
    public function get($key, $default = false)
    {
        return ($this->has($key)) ? $_SESSION[$key] : $default;
    }

    /**
     * [destroy description]
     *
     * @return [type] [description]
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * [delete description]
     *
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * [dump description]
     *
     * @return [type] [description]
     */
    public function dump()
    {
        var_dump($_SESSION);
    }
}
