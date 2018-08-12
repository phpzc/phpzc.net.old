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


    public static function getAccessToken()
    {
        $o = new \CsdnOAuthV2( WB_AKEY , WB_SKEY );

        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;

                return $token;
            } catch (\OAuthException $e) {

            }
        }

        return false;
    }


    public static function getClient($accessToken)
    {
        $c = new \CsdnClientV2( WB_AKEY , WB_SKEY , $accessToken);
        return $c;
    }

}