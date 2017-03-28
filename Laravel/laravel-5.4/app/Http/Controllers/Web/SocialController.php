<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/26
 * Time: 下午12:27
 */

namespace App\Http\Controllers\Web;

use App\Model\User;

class SocialController extends CommonController
{
    public function _initialize() {
        parent::_initialize ();
        $action_name = strtolower ( getCurrentMethod() );
        switch ($action_name) {
            case 'account' :
                $this->assign ( "website_title", "帐号设置" );
                break;
        }
    }

    public final function account() {

        // 根据类型进行参数重置
        /*
         * 姓名 头像 第三方标示ID access_token / openid type
         */

        // 绑定账号

        // 设置不可返回
        session(['has_login_by_social'=>1]);
        $type = 'baidu';
        // 分配 第三方登录 标识
        switch (request()->input('ltype')) {
            case 'baidu' :
                $type = 'baidu' ;
                break;
            case 'qq' :
                $type = 'qq';
                break;
            case 'sina' :
                $type = 'sina';
                break;
            case 'github':
                $type = 'github';
                break;
            case 'battle-us':
                $type = 'battle-us';
                break;
        }

        // 查询是否已经绑定过帐号
        $where = array($type=>session('userid'));
        $result = User::where($where)->first()->toArray();


        if ($result) {

            // 进行登录操作
            $result = $result->toArray();

            session(['name'=>$result ['name']]);
            session(['id'=>$result ['id']]);
            session(['username'=>$result ['username']]);
            session(['login_type'=>$type]);

            header ( 'location:'.NET_NAME );
            exit ();
        }

        // 未绑定
        //dump($_SESSION);
        $this->assign ( 'type', $type );
        $this->assign ( 'username', session('social.username'));
        $this->assign ( 'avatar_img',session('social.avatar_img'));

        return view('social.account');
    }

    public final function github() {

        $this->checkSocialIsLogin();

        if(request()->input('code')){
            $url = "https://github.com/login/oauth/access_token";
            $data['client_id'] = "553e8a51694f0c2de71f";
            $data['redirect_uri']=urlencode(NET_NAME."/social/github");
            $data['client_secret'] = "96ea1e3ded83c1cd8107cddf20170f76eb2441a4";
            $data['code'] = request()->input('code');

            $curlPost = '';

            foreach ($data as $key => $value) {
                $curlPost .= ($key.'='.$value.'&');
            }
            $curlPost = rtrim($curlPost,'&');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
            $data = curl_exec($ch);

            //dump($data);
            curl_close($ch);
            if(empty($data)){
                exit;
            }
            $responseData = explode('&',$data);
            $access_token = explode('=', $responseData[0]);

            $url = "https://api.github.com/user?access_token=".$access_token[1];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            $data = curl_exec($ch);
            //echo $data;
            curl_close($ch);

            $response = json_decode($data,true);

            if($response['error'] != false){
                $this->formErrorReferer('请清除cookie再登陆');
                exit;
            }
            // 进入统一
            session(['social.avatar_img'=>$response ['avatar_url']]);
            session(['social.type'=>'github']);
            session(['social.username'=>$response ['login']]);
            session(['social.email'=>$response ['email']]);
            session(['social.userid'=>$response ['id']]);
            session(['social.access_token'=>$access_token[1]]);
            session(['social.code'=>$_REQUEST['code']]);
            header ( "location:".NET_NAME. "/social/account?ltype=github" );

            exit;
        }

    }

    protected function checkSocialIsLogin()
    {
        if (session('has_login_by_social') == 1) {

            request()->session()->flush();

            header ( "location:".NET_NAME );
            exit ();
        }
    }

    public final function github2()
    {

        $this->checkSocialIsLogin();

        $url = "https://github.com/login/oauth/authorize?";
        $data['client_id'] = "553e8a51694f0c2de71f";
        $data['redirect_uri']=urlencode(NET_NAME."/social/github");
        $data['scope'] = "user,user:email,public_repo";
        $data['state'] = "zc";
        foreach ($data as $key => $value) {
            $url .= ($key."=".$value."&");
        }

        $url = rtrim($url,'&');

        header ( "location:".$url );
    }

    public final function qq()
    {

        $this->checkSocialIsLogin();

        require base_path()."/public/qq/qqConnectAPI.php";
        $qc = new \QC ();

        $access_token = $qc->qq_callback ();
        $openid = $qc->get_openid ();
        $qc = new \QC ( $access_token, $openid );

        $arr = $qc->get_user_info ();

        if ($arr ["ret"] != 0) {
            // 登录有错误 需要跳转
            exit ( "error login" );
        }

        session(['social'=>$arr]);
        session(['social.access_token'=>$access_token]);
        session(['social.openid'=>$openid]);
        session(['social.avatar_img'=>$arr ['figureurl_2']]);
        session(['social.userid'=>$openid]);
        session(['social.username'=>$arr ['nickname']]);
        session(['social.type'=>'qq']);

        // 进入统一跳转
        header ( "location:".NET_NAME . "/social/account?ltype=qq" );
    }

    public final function sina()
    {

        $this->checkSocialIsLogin();

        session(['has_login_by_social'=>0]);
        require_once base_path().'/public/sina/Sina.php';

        $o = new \SaeTOAuthV2 ( WB_AKEY, WB_SKEY );
        if (isset ( $_REQUEST ['code'] )) {
            $keys = array ();
            $keys ['code'] = $_REQUEST ['code'];
            $keys ['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $o->getAccessToken ( 'code', $keys );
            } catch ( OAuthException $e ) {
            }

            if ($token) {
                $_SESSION ['token'] = $token;
                session(['token'=>$token]);
                setcookie ( 'weibojs_' . $o->client_id, http_build_query ( $token ) );
                // 获取用户信息
                //
                $c = new \SaeTClientV2 ( WB_AKEY, WB_SKEY, $token['access_token'] );
                $ms = $c->home_timeline (); // done
                $uid_get = $c->get_uid ();
                $uid = $uid_get ['uid'];
                $user_message = $c->show_user_by_id ( $uid );

                // 进入统一
                session(['avatar_img'=>$user_message ['avatar_hd']]);
                session(['type'=>'sina']);
                session(['userid'=>$token ['uid']]);
                session(['username'=>$user_message ['name']]);
                session(['access_token'=>$token ['access_token']]);

                header ( "location:". NET_NAME . '/social/account?ltype=sina' );

            } else {
                // 授权失败 跳转登录页
                header ( 'location:'. NET_NAME . '/social/sinalogin' );
            }
        }
    }

    /* 新浪登录页url获取与跳转 */
    public final function sinalogin()
    {
        require_once base_path().'/public/sina/Sina.php';

        $o = new \SaeTOAuthV2 ( WB_AKEY, WB_SKEY );
        $code_url = $o->getAuthorizeURL ( WB_CALLBACK_URL );

        header ( "location:" . $code_url . "&forcelogin=true" );
    }

    /* qq登录页 获取与跳转 */
    public final function qqAuth()
    {
        require base_path().'/public/qq/qqConnectAPI.php';
        $qc = new \QC ();
        $qc->qq_login ();
    }
}