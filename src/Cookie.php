<?php

class Cookie
{
    private $expire;
    private $platform;

    /**
     * [__construct description]
     *
     * @param [type] $time [description]
     */
    public function __construct($time = 86400*30, $pf = "Web")
    {
        $this->expire = time() + $time;
        $this->platform = $pf;
    }
        

    public function has($key)
    {
    }
    
    /**
     * [set description]
     *
     * @param [type] $key [description]
     * @param [type] $val [description]
     */
    public function set($key, $val)
    {
        if ($this->platform == "Web") {
            setcookie($key, $val, $this->expire);
        } else {
            $_COOKIE[$key] = $val;
        }
    }
    

    public function get($key, $default = false)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return $default;
        }
    }
    

    public function dump()
    {
        echo "<pre>" . htmlentities(print_r($_COOKIE, 1)) . "</pre>";
    }
    

    public function delete($key)
    {
    }
    
    /**
     * [destroy description]
     *
     * @return [type] [description]
     */
    public function destroy()
    {
        if ($this->platform == "Web") {
            foreach ($_COOKIE as $key => $value) {
                setcookie($key, $value, time()-3600);
            }
        } else {
            foreach ($_COOKIE as $key => $value) {
                unset($_COOKIE[$key]);
            }
        }
    }
}
