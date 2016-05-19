<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/19
 * Time: 12:02
 */
class ApiCode
{

    //=====系统级别错误
    const SYS_ERROR = 10001;

    //=====服务级别错误
    const SERVICE_ERROR = 20001;

    //=====错误说明
    private $error = array(

        self::SYS_ERROR=>'系统错误',
        

    );

    /**
     * 取得错误消息
     * @param $errorCode
     * @return mixed
     */
    public static function M($errorCode)
    {
        return self::$error[(int)$errorCode];
    }
}
