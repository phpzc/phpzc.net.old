<?php
/**
 * Common function
 */

if(!function_exists('is_ssl')){
    function is_ssl()
    {
        if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
            return true;
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }
        return false;
    }

}


?>