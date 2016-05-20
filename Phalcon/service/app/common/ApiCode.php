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
    const SYS_HTTP_ERROR = 10000;
    const SYS_INVALID_KEY_SECRET = 10001;
    const SYS_INVALID_TOKEN = 10002;
    const SYS_TOKEN_EXPIRED = 10003;
    const SYS_SET_TOKEN_ERROR = 10004;
    const SYS_INVALID_OLD_TOKEN = 10005;
    const SYS_NO_RETURN = 10006;
    const SYS_INFO_WILE_EXPIRE = 10007;

    //=====服务级别错误
    const SERVICE_ERROR = 20001;

    //=====错误说明
    private static $error = array(
        self::SYS_HTTP_ERROR => 'system code error or sever down',
        self::SYS_INVALID_KEY_SECRET=>'invalid key and secret',
        self::SYS_INVALID_TOKEN=>'invalid access token ',
        self::SYS_TOKEN_EXPIRED=>'access token expired',
        self::SYS_SET_TOKEN_ERROR=>'set access token failed',
        self::SYS_INVALID_OLD_TOKEN=>'invalid old access token for new access token',
        self::SYS_NO_RETURN => 'system no response or appear error json',
        self::SYS_INFO_WILE_EXPIRE => 'access token will expire',
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

class Api extends ApiCode{}

function AM($code)
{
    return Api::M($code);
}
