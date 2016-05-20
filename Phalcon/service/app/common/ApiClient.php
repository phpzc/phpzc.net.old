<?php

/**
 * Class ApiClient 客户端接口使用类
 *
 * @package
 */
class ApiClient
{
    public $oauth = null;

    /**
     * 构造函数
     *
     * @access public
     *
     * @param mixed $app_key    应用APP $app_key
     * @param mixed $api_secret    应用APP $app_secret
     * @param mixed $access_token  OAuth认证返回的token
     * @param mixed $refresh_token 没用上
     *
     */
    function __construct($app_key, $app_secret, $access_token = null, $refresh_token = NULL)
    {

        $this->oauth = new ApiAuth($app_key, $app_secret, $access_token, $refresh_token);

        if ($access_token == null) {
            $token = $this->oauth->getAccessToken();

            $_SESSION['api_access_token'] = $token;
        }

    }

    public function call_api($url, $method, $params = array(),$headers= array(),$debug = false)
    {
        $response = null;
        $method = strtoupper($method);


        switch ($method) {
            case 'GET':
                $response = $this->oauth->OAuthRequest($url,'GET', $params,$headers,$debug);
                break;
            default:
                $response = $this->oauth->OAuthRequest($url,'POST',$params,$headers,$debug);
                break;
        }

        $responseResult = json_decode($response, true);
        if ($this->oauth->http_code != 200 ) {

            return array(
                'error_code' => ApiCode::SYS_HTTP_ERROR,
                'error_message' => AM(ApiCode::SYS_HTTP_ERROR) . 'Api Server error Http Code' . $this->oauth->http_code,
            );
        }else if(empty($responseResult)){
            return array(
                'error_code' => ApiCode::SYS_NO_RETURN,
                'error_message' => AM(ApiCode::SYS_NO_RETURN) . 'Api Server error Http Code' . $this->oauth->http_code,
            );

        } else {
            //判断token即将过期的情况 重新获取token
            if(isset($responseResult['error_code']) ){

                switch($responseResult['error_code'] ){
                    case Api::SYS_INFO_WILE_EXPIRE:

                        RC()->del('cookie_'.$_SERVER['REMOTE_ADDR']);

                        if($token = $this->oauth->refreshToken()){
                            $_SESSION['api_access_token'] = $token;
                            return $this->call_api($url, $method, $params,$headers);
                        }
                    break;
                    case Api::SYS_INVALID_TOKEN:
                        RC()->del('cookie_'.$_SERVER['REMOTE_ADDR']);
                        $token = $this->oauth->getAccessToken();
                        $_SESSION['api_access_token'] = $token;
                        return $this->call_api($url, $method, $params,$headers);
                        break;
                }


            }
            return $responseResult;
        }

    }


    public function test_index()
    {
        return $this->call_api(ApiUrl::URL(ApiUrl::TEST_INDEX),'GET',[]);
    }
}


function API()
{
    static $requestObj;

    if($requestObj == null){
        $token = null;
        if(  !empty($_SESSION['api_access_token']) ){
            $token = $_SESSION['api_access_token'];
        }

        //方便测试API
//        if( !empty($_REQUEST['access_token']) ){
//            $token = $_REQUEST['access_token'];
//        }
        $config = include APP_PATH . "/app/config/config.php";
        $requestObj = new ApiClient($config->api->app_key,$config->api->app_secret, $token);

    }

    return $requestObj;
}