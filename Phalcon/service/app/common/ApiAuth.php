<?php

/**
 * Class ApiAuth 接口http请求和授权类
 * @package
 */
class ApiAuth
{
    public $api_key;
    public $api_secret;
    public $access_token;
    public $refresh_token;// 没用上
    public $token_expire_time = 0;

    public $connect_timeout=10;
    public $timeout = 10;
    public $http_code;
    public $http_info;

    public $debug = false;


    //获取access token 刷新token
    function accessTokenURL(){ return NET_NAME.'/api/access_token';}

    //目前授权页先直接返回token
    function authorizeURL(){ return '';}

    //刷新access token 刷新token
    function refreshTokenURL() { return NET_NAME.'/api/refreshToken';}
    /**
     * construct OAuth object
     */
    function __construct($api_key, $api_secret, $access_token = NULL, $refresh_token = NULL) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;

        if(!extension_loaded('curl')){
            throw new \Exception('curl extension not loaded!');
        }
    }

    /**
     *
     *
     * @todo 待定
     * @param string $response_type
     *
     * @return string
     */
    function getAuthorizeURL($response_type = 'token')
    {
        $params = array();
        $params['api_key'] = $this->api_key;
        $params['response_type'] = $response_type;

        return $this->authorizeURL().'?'.http_build_query($params);
    }

    /**
     * 获取token
     * @param string $type
     *
     * @return null
     */
    function getAccessToken($type = 'token')
    {
        $params = array();
        $params['api_key'] = $this->api_key;
        $params['api_secret'] = $this->api_secret;
        $params['ip'] = $_SERVER['REMOTE_ADDR'];
        if($this->access_token!=null){
            $params['old_access_token'] = $this->access_token;
        }
        if($type == 'token'){
            $params['grant_type'] = 'refresh_token';
        }else{
            throw new \Exception('wrong auth type');
        }

        $response = $this->OAuthRequest($this->accessTokenURL(),'POST',$params);

        $token = json_decode($response,true);

        if ( is_array($token) && !isset($token['error']) ) {
            $this->access_token = $token['access_token'];
            $this->token_expire_time = $token['expire_time'];
        } else {
            throw new \Exception("get access token failed." . $token['error']);
        }
        return $this->access_token;

    }

    function refreshToken()
    {
        $params = array();
        $params['api_key'] = $this->api_key;
        $params['api_secret'] = $this->api_secret;
        $params['ip'] = $_SERVER['REMOTE_ADDR'];
        $params['old_access_token'] = $this->access_token;
        $response = $this->OAuthRequest($this->refreshTokenURL(),'POST',$params);

        $token = json_decode($response,true);

        if ( is_array($token) && !isset($token['error']) ) {
            $this->access_token = $token['access_token'];
            $this->token_expire_time = $token['expire_time'];
            return $this->access_token;

        } else {
            return false;
        }

    }
    /**
     * 设置请求参数
     *
     * @param $url
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    function OAuthRequest($url,$method,$params,$debug = false)
    {

        if ( isset($this->access_token) && $this->access_token )
            $params['access_token'] = $this->access_token;

        switch($method){
            case 'GET':
                $url = $url.'?'.http_build_query($params);
                return $this->http($url,'GET',NULL,NULL,$debug);
            default:
                $headers = array();
                $body = $params;
                return $this->http($url, $method, http_build_query($body), $headers,$debug);

        }
    }


    function http($url, $method, $postfields = NULL, $headers = array(),$debug = false)
    {
        $this->http_info = array();
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connect_timeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ci, CURLOPT_ENCODING, "");
        curl_setopt($ci, CURLOPT_HEADER, FALSE);

        switch($method){
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($postfields)) {

                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                }
                break;
            case 'GET':
                break;
        }

        curl_setopt($ci, CURLOPT_URL, $url );
        if(empty($headers)){
            $headers = array();
        }
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );

        $response = curl_exec($ci);
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));


        if ($this->debug || $debug) {
            echo "=====post data======\r\n";
            var_dump($postfields);

            echo "=====headers======\r\n";
            print_r($headers);

            echo '=====request info====='."\r\n";
            print_r( curl_getinfo($ci) );

            echo '=====response====='."\r\n";
            print_r( $response );
        }
        curl_close ($ci);

        return $response;
    }



}