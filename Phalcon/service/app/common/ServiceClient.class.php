<?php

/**
 * Class ServiceClient 服务层客户端接口使用类
 *
 * @package Hmd\Common
 */
class ServiceClient
{
    public $oauth = null;

    /**
     * 构造函数
     *
     * @access public
     *
     * @param mixed $api_key       应用APP $api_key
     * @param mixed $api_secret    应用APP $api_secret
     * @param mixed $access_token  OAuth认证返回的token
     * @param mixed $refresh_token 没用上
     *
     */
    function __construct($api_key, $api_secret, $access_token = null, $refresh_token = NULL)
    {

        $this->oauth = new ServiceAuth($api_key, $api_secret, $access_token, $refresh_token);

        if ($access_token == null) {
            $token = $this->oauth->getAccessToken();
            $_SESSION['api_access_token'] = $token;
        }
    }

    public function call_api($url, $method, $params = array(),$debug = false)
    {
        $response = null;
        $method = strtoupper($method);
        switch ($method) {
            case 'GET':
                $response = $this->oauth->OAuthRequest($url,'GET', $params,$debug);
                break;
            default:
                $response = $this->oauth->OAuthRequest($url,'POST',$params,$debug);
                break;
        }

        $responseResult = json_decode($response, true);
        if ($this->oauth->http_code != 200 || empty($responseResult)) {

            return array(
                'error' => true,
                'status' => -1,
                'data' => array(),
                'content' => 'Service服务器错误' . $this->oauth->http_code,
                'response'=>$response,
                'code' => $this->oauth->http_code
            );

        } else {


            //判断token即将过期的情况 重新获取token
            if($responseResult['status'] == -99999999 ){

                if($token = $this->oauth->refreshToken()){
                    $_SESSION['api_access_token'] = $token;
                    return $this->call_api($url, $method, $params);
                }
            }


            return $responseResult;
        }

    }


}