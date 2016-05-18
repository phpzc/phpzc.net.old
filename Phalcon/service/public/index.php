<?php

error_reporting(E_ALL);

define('APP_PATH', realpath(dirname(__DIR__)));

try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    //load Constants class
    include APP_PATH."/app/config/constants.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    //load self files
    include APP_PATH . "/app/common/functions.php";
    include APP_PATH . "/app/common/define.php";


    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
