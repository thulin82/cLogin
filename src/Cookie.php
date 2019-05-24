<?php

class Cookie
{
    private $expire;
    private $platform;

    /**
     * [__construct description]
     *
     * @param int    $time [description]
     * @param string $pf
     */
    public function __construct($time = 86400*30, $pf = "Web")
    {
        $this->expire = time() + $time;
        $this->platform = $pf;
    }
        
    /**
     * Undocumented function
     *
     * @param  string $key
     * @return string $key
     */
    public function has($key)
    {
        return $key;
    }
    
    /**
     * [set description]
     *
     * @param string $key [description]
     * @param string $val [description]
     */
    public function set($key, $val)
    {
        if ($this->platform == "Web") {
            setcookie($key, $val, $this->expire);
        } else {
            $_COOKIE[$key] = $val;
        }
    }
    
    /**
     * Undocumented function
     *
     * @param  string $key
     * @param  boolean $default
     * @return bool
     */
    public function get($key, $default = false)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return $default;
        }
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function dump()
    {
        echo "<pre>" . htmlentities(print_r($_COOKIE, 1)) . "</pre>";
    }
    
    /**
     * Undocumented function
     *
     * @param  string $key
     * @return string $key 
     */
    public function delete($key)
    {
        return $key;
    }
    
    /**
     * Undocumented function
     *
     * @return void
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
