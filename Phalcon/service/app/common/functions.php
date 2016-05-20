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

if(!function_exists('RC'))
{
    /**
     * redis client
     * @return null|Redis
     * @throws Exception
     */
    function RC()
    {
        static $redis = null;

        if($redis == null){
            $config = include APP_PATH . "/app/config/config.php";
            $redis = new Redis();
            if(!$redis->connect($config->redis->host,$config->redis->port,3))
            {
                throw new Exception('connect redis fail');
            }

            if($config->redis->auth){
                $redis->auth($config->redis->auth);
            }

            $redis->select($config->redis->db_num);
        }

        return $redis;
    }
    
}
?>