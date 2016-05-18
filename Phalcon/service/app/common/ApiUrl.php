<?php

class ApiUrl
{
    const API_BASE = NET_NAME.'/api/index/';
    const CATEGORY_GET = 'category/get';

    const ALL_API = array(
        self::CATEGORY_GET,
    );

    public static function checkApi($controller,$action)
    {
        return in_array($controller.'/'.$action,self::ALL_API);
    }

}
