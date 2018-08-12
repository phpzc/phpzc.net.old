<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2018/8/12
 * Time: 上午10:52
 */

namespace App\Service;


define( "WB_AKEY" , env('CSDN_WB_AKEY','') );
define( "WB_SKEY" , env('CSDN_WB_SKEY',''));
define( "WB_CALLBACK_URL" , env('CSDN_WB_CALLBACK_URL','') );

include_once __DIR__.'/csdnapi.class.php';


class CsdnService extends Service
{
    public static function getLoginUrl()
    {

        $o = new \CsdnOAuthV2( WB_AKEY , WB_SKEY );

        $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

        return $code_url;
    }

}