<?php

class Cookie
{
    /**
     * Expire time
     *
     * @var integer $expire Expire time
     */
    private $expire;

    /**
     * Platform used
     *
     * @var string $platform Platform used
     */
    private $platform;

    /**
     * Constructor
     *
     * @param int    $time Expiry time, default 30 days
     * @param string $pf   Platform
     *
     * @return void
     */
    public function __construct($time = 86400*30, $pf = "Web")
    {
        $this->expire = time() + $time;
        $this->platform = $pf;
    }
        
    /**
     * Check if key exists in $_COOKIE
     *
     * @param string $key The key to check for
     *
     * @return bool true if it exists, otherwise false
     */
    public function has($key)
    {
        return array_key_exists($key, $_COOKIE);
    }
    
    /**
     * Set cookie
     *
     * @param string $key The name of the cookie
     * @param string $val The value of the cookie
     *
     * @return void
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
     * Get cookie
     *
     * @param string  $key     The key to get from $_COOKIE
     * @param boolean $default The default value returned
     *
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
     * @return string
     */
    public function dump()
    {
        return "<pre>" . htmlentities(print_r($_COOKIE, 1)) . "</pre>";
    }
    
    /**
     * Undocumented function
     *
     * @param string $key The key to delete from $_COOKIE
     *
     * @return void
     */
    public function delete($key)
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
        }
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
