<?php

/**
 * [myAutoloader description]
 *
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
function myAutoloader($class)
{
    $path = sprintf('src/%s.php', $class);
    if (is_file($path)) {
        include $path;
    }
}
spl_autoload_register('myAutoloader');
