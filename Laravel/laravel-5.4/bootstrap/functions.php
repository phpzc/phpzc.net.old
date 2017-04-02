<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/28
 * Time: 16:31
 */

if (! function_exists('ADMIN')) {

    function ADMIN($file)
    {
        return '/Public/AdminLTE/'.$file;
    }
}


if(! function_exists('CSS')){
    function CSS($file)
    {
        return '/Public/css/'.ltrim($file,'/');
    }
}

if(! function_exists('JS')){
    function JS($file)
    {
        return '/Public/js/'.ltrim($file,'/');
    }
}

if(! function_exists('CUBE')){
    function CUBE($file = '')
    {
        return '/Public/cube/'.ltrim($file,'/');
    }
}

if(! function_exists('IMG')){
    function IMG($file)
    {
        return '/Public/img/'.ltrim($file,'/');
    }
}
if(! function_exists('KINDEDITOR')){
    function KINDEDITOR($file = '')
    {
        return '/Public/kindeditor/'.ltrim($file,'/');
    }
}

if(! function_exists('BAIDU')){
    function BAIDU($file)
    {
        return '/Public/baidu/'.ltrim($file,'/');
    }
}

if(! function_exists('WIN8')){
    function WIN8($file)
    {
        return '/Public/win8/'.ltrim($file,'/');
    }
}

if( !function_exists('PUBLICS'))
{
    function PUBLICS($file)
    {
        return '/Public/'.ltrim($file,'/');
    }
}


if( !function_exists('UEDITOR'))
{
    function UEDITOR($file)
    {
        return '/Public/baidu/UEditor/'.ltrim($file,'/');
    }
}

if( !function_exists('MD'))
{
    function MD($file = '')
    {
        return '/Public/editor.md-master/'.ltrim($file,'/');
    }
}

if (! function_exists('S')) {

    function S($service_name)
    {
        $service_name = ucfirst(strtolower($service_name));

        $class = '\\App\\Service\\'.$service_name.'Service';
        if(class_exists($class)){
            return new $class;
        }
    }
}

if (! function_exists('M')) {


    /**
     * @param $model_name
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    function M($model_name)
    {
        $model_name = ucfirst(strtolower($model_name));

        $class = '\\App\\Model\\'.$model_name;
        if(class_exists($class)){
            return new $class;
        }
    }
}

if(! function_exists('dump')) {

    /**
     * 浏览器友好的变量输出
     * @param mixed $var 变量
     * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
     * @param string $label 标签 默认为空
     * @param boolean $strict 是否严谨 默认为true
     * @return void|string
     */
    function dump($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }

}

if(!function_exists('is_ssl')){

    /**
     * 判断是否SSL协议
     * @return boolean
     */
    function is_ssl() {
        if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
            return true;
        }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
            return true;
        }
        return false;
    }
}


if(!function_exists('get_client_ip'))
{
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    function get_client_ip($type = 0,$adv=false) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}

if(!function_exists('send_http_status'))
{
    /**
     * 发送HTTP状态
     * @param integer $code 状态码
     * @return void
     */
    function send_http_status($code) {
        static $_status = array(
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',
            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily ',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',
            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded'
        );
        if(isset($_status[$code])) {
            header('HTTP/1.1 '.$code.' '.$_status[$code]);
            // 确保FastCGI模式下正常
            header('Status:'.$code.' '.$_status[$code]);
        }
    }
}

if( !function_exists('isMobileRequest'))
{
    /**
     * 处理是否手机请求
     *
     * @return boolean
     */
    function isMobileRequest()
    {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }
        //	 检查浏览器是否接受 WML.
        if ((isset($_SERVER['HTTP_ACCEPT']))
            && (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false)
        ) {
            $mobile_browser++;
        }
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            $mobile_browser++;
        }
        if (isset($_SERVER['HTTP_PROFILE'])) {
            $mobile_browser++;
        }
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        //	检查USER_AGENT
        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) {
            $mobile_browser++;
        }
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) {
            $mobile_browser = 0;
        }
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) {
            $mobile_browser++;
        }
        if ($mobile_browser > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if( !function_exists('is_get'))
{
    /**
     * 是否是 GET请求
     *
     * @return bool
     */
    function is_get()
    {
        return 'GET' == request()->method();
    }
}


if( !function_exists('is_ajax'))
{
    /**
     * 是否是ajax请求
     * @return bool
     */
    function is_ajax()
    {
        return request()->isXmlHttpRequest();
    }
}



if(is_ssl()){
    define("NET_NAME","https://" . isset($_SERVER ["HTTP_HOST"])? $_SERVER ["HTTP_HOST"]:'');
}else{
    define("NET_NAME","http://" . isset($_SERVER ["HTTP_HOST"])? $_SERVER ["HTTP_HOST"]:'' );
}

define('ACTION_SUCCESS',1);
define('ACTION_ERROR',0);



function percent_func($all,$view)
{
    if($view ==0){
        echo 0;
        return;
    }

    $n = $view /$all;
    if($n > 1){
        echo 100;
    }else if($n < 0.02){
        echo 1;
    }else{
        $n *= 100;
        $n = (int)($n);
        $n %= 100;

        echo $n;
    }

}


/**
 *  截取指定的中英文字符的长度code支持utf-8 和gb2312 两种格式
 */
function cut_str($string, $sublen, $start = 0, $code = 'utf-8'){

    if($code == 'utf-8'){

        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";

        preg_match_all($pa, $string, $t_string);
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";

        return join('', array_slice($t_string[0], $start, $sublen));

    }else{
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
        for($i=0; $i< $strlen; $i++){
            if($i>=$start && $i< ($start+$sublen)){
                if(ord(substr($string, $i, 1))>129){
                    $tmpstr.= substr($string, $i, 2);
                }else{
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129)
                $i++;
        }
        //超出多余的字段就显示...
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }

}

function findImageUrl($content)
{
    $preg = "/\<img src=\"(.*?)\"/";
    $arr= array();
    preg_match($preg,htmlspecialchars_decode($content),$arr);
    if(count($arr) >0)
    {
        return $arr[1];
    }else{
        //return "/Public/img/default_img1.jpg";
        //return "<img src='/Public/img/background/logo.gif' style='margin:auto;'/>";
        return "";
    }

}


function sstrlen($str,$charset) {
    $n = 0; $p = 0; $c = '';
    $len = strlen($str);
    if(strtolower($charset) == 'utf-8') {
        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 252) {
                $p = 5;
            } elseif($c > 248) {
                $p = 4;
            } elseif($c > 240) {
                $p = 3;
            } elseif($c > 224) {
                $p = 2;
            } elseif($c > 192) {
                $p = 1;
            } else {
                $p = 0;
            }
            // echo $p.'<br/>';
            $i+=$p;
            $n++;
            //计算第一个字符是什么 然后判断一个字 占几个字符
        }
    } else {
        // gbk计算方式  2个字符算1个长度
        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 127) {
                $p = 1;
            } else {
                $p = 0;
            }
            $i+=$p;$n++;
        }
    }
    return $n;
}


//截图函数
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale,$quality=90){
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    $source = imagecreatefromjpeg($image);
    imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    imagejpeg($newImage,$thumb_image_name,$quality);
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
}

function getword($str,$charset='utf-8') {
    $n = 0; $p = 0; $c = '';
    $len = strlen($str);
    $arr= array();
    if(strtolower($charset) == 'utf-8') {

        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 252) {
                $p = 5;
            } elseif($c > 248) {
                $p = 4;
            } elseif($c > 240) {
                $p = 3;
            } elseif($c > 224) {
                $p = 2;
            } elseif($c > 192) {
                $p = 1;
            } else {
                $p = 0;
            }
            $arr[] = substr($str,$i,$p+1);
            $i += $p;
            $n++;
        }
    } else {
        // gbk计算方式  2个字符算1个长度
        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 127) {
                $p = 1;
            } else {
                $p = 0;
            }
            $arr[] = substr($str,$i,$p+1);
            $i += $p;
            $n++;

        }
    }

    $result = array('length'=>$n,'word'=>$arr);
    return $result;

}
function getLength($str)
{
    $arr = getword($str);
    return $arr['length'];
}
/*根据bpath获取分类名称*/
function getCategoryName($path)
{
    $arr = explode("-",$path);
    $res = NULL;
    foreach($_SESSION["website"]["category"] as $k=>$v){

        if($v["id"] == $arr[1]){
            $res = $v["name"];
            break;
        }
    }
    return $res;
}

/*根据bpath获取分类css*/
function getCategoryClassName($path)
{
    $name = strtolower(getCategoryName($path));
    if ($name == "c++"){
        $name = "cpp";
    }


    return 'c_'.$name;
}

/*根据category id 获取名字*/
function getCategoryNameById($id)
{
    $res = "";
    foreach($_SESSION["website"]["category"] as $k=>$v){

        if($v["id"] == $id){
            $res = $v["name"];
            break;
        }
    }
    return $res;
}

/*根据tag id 获取名字*/
function getTagNameById($tag)
{
    $res = "";
    foreach($_SESSION["website"]["tag"] as $k=>$v){

        if($v["id"] == $tag){
            $res = $v["name"];
            break;
        }
    }
    return $res;
}


/*根据bpath 获取顶级分类id*/
function getCategoryId($path)
{
    $arr = explode("-",$path);
    return $arr[1];
}

//资料 文件格式图片
function getDocumentTypeImage($type)
{
    $img = "";
    switch($type)
    {
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
        case 5:
            break;
    }
    return $img;
}
//资料 存储网盘类型图片
function getDocumentStoreTypeImage($type)
{
    $img = "";
    switch($type)
    {
        case 1:

            break;
        case 2:

            break;
        case 3:

            break;

    }
    return $img;
}


/**
 * json返回函数统一调用
 * @param data 返回结果数组
 * @param errorCode 成功还是失败码 0成功 1失败
 * @return void
 */
function jsonPrint($data,$errorCode)
{
    if ($errorCode == 0){
        jsonSuccess($data);
    } else{
        jsonError($data);
    }
}
/**
 * json返回函数统一调用
 * @param data 如果errorCode为1 自动追加为error_str 否则视为 array
 * @param errorCode 成功还是失败码 0成功 1失败
 * @return void
 */
function jsonP($data,$errorCode)
{
    if ($errorCode == 0){
        jsonSuccess($data);
    } else{
        jsonError(array("error_str"=>$data));
    }
}

function jsonSuccess($data)
{
    $arr = array(
        "success"=>1,
        "error_str"=>"",
    );
    $arr = array_merge($arr,$data);
    echo json_encode($arr,true);
    exit();
}
function jsonError($data)
{
    $arr = array(
        "success"=>0,
        "error_str"=>$data['error_str'],
    );
    $arr = array_merge($arr,$data);
    echo json_encode($arr,true);
    //dump($arr);
    exit();
}

function encodeId($id) {
    $mid = md5 ( $id );
    $str = substr ( $mid, 0, 16 );
    $str .= $id;
    $str .= substr ( $mid, 16, 16 );
    return $str;
}

function base_encode($url)
{
    $url = base64_encode($url);

    $url = strtr($url,'+/=','-!_');

    return $url;
}
function base_decode($url)
{

    $url = strtr($url,'-!_','+/=');

    $url = base64_decode($url);

    return $url;
}

function send_email($toAddress,$toName,$subject='',$body='')
{
//    //import ( "ORG.Util.PHPMailer" );
//    include_once LIB_PATH.'Org/Util/Phpmailer.class.php';
//    $mail = new PHPMailer (); // 建立邮件发送类
//    $address = C("EMAIL_USER");
//    $mail->IsSMTP (); // 使用SMTP方式发送
//    $mail->CharSet='utf8';
//    //$mail->IsHTML();
//    $mail->Host = C('EMAIL_HOST'); // 您的企业邮局域名
//    $mail->SMTPAuth = true; // 启用SMTP验证功能
//    $mail->Username = C("EMAIL_USER"); // 邮局用户名(请填写完整的email地址)
//    $mail->Password = C("EMAIL_PWD"); // 邮局密码
//    $mail->Port = C('EMAIL_PORT');
//    $mail->From = C("EMAIL_USER"); // 邮件发送者email地址
//    $mail->FromName = C("EMAIL_USERNAME");
//    $mail->AddAddress ( $toAddress, $toName ); // 收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//
//    $mail->IsHTML(true);
//
//
//    $mail->Subject = $subject; // 邮件标题
//    $mail->Body = $body; // 邮件内容
//
//    return $mail->Send();

    return false;
}


/**
 * 返回国家省市地区
 * @param $ip
 * @return string
 */
function getIPLoc_taobao($ip)
{
    $result = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");

    $result = json_decode($result,true);

    $ipInfo = $result['data'];

    $data = $ipInfo['country'].$ipInfo['region'].$ipInfo['city'];////国家省市
    if(empty($data)){
        $data = '地球';
    }
    return $data;
}


/**
 * redis实例
 */
function RC()
{
    static $obj = null;

    if($obj == null) {
        $obj = new \Redis();
        $obj->connect('127.0.0.1');
        $obj->auth(env('REDIS_PASSWORD',''));
        $obj->select(0);
    }

    return $obj;
}


/**
 * 添加ip记录
 */
function add_ip_record()
{
    $ip = get_client_ip(0,true);
    $date = date('Ymd');

    $find = \App\Model\Visit::where(['day'=>$date,'ip'=>$ip])->first();
    if($find) {
        \App\Model\Visit::where(['id'=>$find['id']])->increment('num');
    }else{
        \App\Model\Visit::insert(['ip'=>$ip,'day'=>$date,'num'=>1]);
    }
}

function get_site_url()
{
    return 'https://www.phpzc.net';
}


/**
 *
 * 获取当前请求的控制器名称 不带Controller
 *
 *
 *
 * @return mixed|string
 */
function getCurrentController()
{
    if(defined('CONTROLLER_NAME')){
        return CONTROLLER_NAME;
    }


    $url = Route::current()->getActionName();

    $arr1 = explode('@',$url);
    $arr2 = explode('\\',$arr1[0]);

    $controller = (array_pop($arr2));
    $controller = substr($controller,0,-10);

    define('CONTROLLER_NAME',$controller);

    return $controller;

}


/**
 * 获取当前请求的控制器方法名
 *
 * @return mixed
 */
function getCurrentMethod()
{

    if(defined('ACTION_NAME')){
        return ACTION_NAME;
    }

    $url = Route::current()->getActionName();

    $arr1 = explode('@',$url);

    define('ACTION_NAME',$arr1[1]);

    return $arr1[1];
}

