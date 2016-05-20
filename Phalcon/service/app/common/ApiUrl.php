<?php

define('APP_IDENTITY_DEFAULT',sha1('phpzc-phpzc'));

class ApiUrl
{
    const API_BASE = NET_NAME.'/api/index/';
    const CATEGORY_GET = 'category/get';
    const TEST_INDEX = 'test/index';
    const ALL_API = array(
        self::CATEGORY_GET,
        self::TEST_INDEX,
    );

    const APP_IDENTITY = array(
        APP_IDENTITY_DEFAULT
    );
    
    public static function checkApi($controller,$action)
    {
        return in_array($controller.'/'.$action,self::ALL_API);
    }

    public static function URL($url)
    {
        return self::API_BASE.$url;
    }
}
