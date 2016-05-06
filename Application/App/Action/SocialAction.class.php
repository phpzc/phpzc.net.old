<?php

namespace App\Action;
/**
 * 第三方登录
 * 
 * @author zhangcheng <lampzhangcheng@gmail.com>
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Copyright (c) 2014, ZhangCheng 2014/04/21
 */
class SocialAction extends CommonAction {
	/*
	 * @brief 设置每一页标题
	 */
	public function _initialize() {
		parent::_initialize ();
		$action_name = strtolower ( ACTION_NAME );
		switch ($action_name) {
			case 'account' :
				$this->assign ( "website_title", "帐号设置" );
				break;
		}
	}
	
	/*
	 * 第三方登录 判断 页面 已绑定 跳转至来源页 未绑定 跳转至绑定页
	 */
	public function index() {
		$this->display ( "public:404" );
	}
	public function baidu() {
		if ($_SESSION ['has_login_by_social'] == 1) {
			

			cookie ( null );
			session ( null );
			
			header ( "location:http://www." . $_SERVER ["SERVER_NAME"] );
			exit ();
		}
		
		import ( "ORG.Util.Baidu" );
		if (isset ( $_REQUEST ['code'] )) {
			$code = $_REQUEST ['code'];
		} else {
			cookie ( null );
		}
		// $code = $_REQUEST['code'] ? $_REQUEST['code'] : ;
		
		$client_id = 'fgIIRGufGdzh5h0mE0BT4tM1';
		$client_secret = 'FhawiSi2FlSxIBlvn0i0eeLqut8k1hmE';
		$redirect_uri = "http://www." . $_SERVER ["SERVER_NAME"].'/social/baidu.html';
		
		$baidu = new Baidu ( $client_id, $client_secret, $redirect_uri, new BaiduCookieStore ( $client_id ) );
		
		// Get User ID and User Name
		$user = $baidu->getLoggedInUser ();
		
		if ($user) {
			
			// dump($user);
			// exit;
			$apiClient = $baidu->getBaiduApiClientService ();
			$profile = $apiClient->api ( '/rest/2.0/passport/users/getInfo', array (
					'fields' => 'userid,username,portrait' 
			) );
			// portrait -> 头像
			if ($profile === false) {
				
				// get user profile failed
				 var_dump(var_export(array('errcode' => $baidu->errcode(),
				 'errmsg' => $baidu->errmsg()), true));
				
				var_dump ( $profile );
				$user = null;
				
				exit ();
			} else {
				// 绑定账号
				// 设置session信息
				// dump($profile);
				$_SESSION ['Auth'] ['Social'] = $profile;
				$_SESSION ['Auth'] ['Social'] ['avatar_img'] = "http://tb.himg.baidu.com/sys/portrait/item/" . $profile ['portrait'];
				
				$_SESSION ['Auth'] ['Social'] ['type'] = 'baidu';
				header ( "location:http://www." . $_SERVER ["SERVER_NAME"] . "/social/account.html?ltype=baidu" );
				exit ();
			}
		} else {
			// 跳转到登录页
			$loginUrl = $baidu->getLoginUrl ( '', 'popup' );
			header ( "location:" . $loginUrl );
		}
	}
	public function qq() {
		if ($_SESSION ['has_login_by_social'] == 1) {
			

			cookie ( null );
			session ( null );
			
			header ( "location:http://www." . $_SERVER ["SERVER_NAME"] );
			exit ();
		}
		
		require_once ("./qq/qqConnectAPI.php");
		$qc = new QC ();
		
		$access_token = $qc->qq_callback ();
		$openid = $qc->get_openid ();
		$qc = new QC ( $access_token, $openid );
		
		$arr = $qc->get_user_info ();
		
		if ($arr ["ret"] != 0) {
			// 登录有错误 需要跳转
			exit ( "error login" );
		}
		$_SESSION ['Auth'] ['Social'] = $arr;
		$_SESSION ['Auth'] ['Social'] ['access_token'] = $access_token;
		$_SESSION ['Auth'] ['Social'] ['openid'] = $openid;
		$_SESSION ['Auth'] ['Social'] ['avatar_img'] = $arr ['figureurl_2'];
		$_SESSION ['Auth'] ['Social'] ['userid'] = $openid;
		$_SESSION ['Auth'] ['Social'] ['username'] = $arr ['nickname'];
		$_SESSION ['Auth'] ['Social'] ['type'] = 'qq';
		
		// 进入统一跳转
		header ( "location:http://www." . $_SERVER ["SERVER_NAME"] . "/social/account.html?ltype=qq" );
	}
	public function sina() {
		if ($_SESSION ['has_login_by_social'] == 1) {
			

			cookie ( null );
			session ( null );
			
			header ( "location:http://www." . $_SERVER ["SERVER_NAME"] );
			exit ();
		}
		$_SESSION ['has_login_by_social'] = 0;
		

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
				setcookie ( 'weibojs_' . $o->client_id, http_build_query ( $token ) );
				// 获取用户信息
				//
				$c = new \SaeTClientV2 ( WB_AKEY, WB_SKEY, $_SESSION ['token'] ['access_token'] );
				$ms = $c->home_timeline (); // done
				$uid_get = $c->get_uid ();
				$uid = $uid_get ['uid'];
				$user_message = $c->show_user_by_id ( $uid );
				
				// 进入统一
				$_SESSION ['Auth'] ['Social'] ['avatar_img'] = $user_message ['avatar_hd'];
				
				$_SESSION ['Auth'] ['Social'] ['type'] = 'sina';
				$_SESSION ['Auth'] ['Social'] ['username'] = $user_message ['name'];
				$_SESSION ['Auth'] ['Social'] ['userid'] = $token ['uid'];
				$_SESSION ['Auth'] ['Social'] ['access_token'] = $token ['access_token'];
				
				
				header ( "location:http://www." . $_SERVER ["SERVER_NAME"] . "/social/account.html?ltype=sina" );
				// dump($_SESSION);
			} else {
				// 授权失败 跳转登录页
				header ( "location:http://www." . $_SERVER ["SERVER_NAME"] . "/social/sinalogin.html" );
			}
		}
	}
	
	/* 新浪登录页url获取与跳转 */
	public function sinalogin() {

		$o = new \SaeTOAuthV2 ( WB_AKEY, WB_SKEY );
		$code_url = $o->getAuthorizeURL ( WB_CALLBACK_URL );
		
		header ( "location:" . $code_url . "&forcelogin=true" );
	}
	
	/* qq登录页 获取与跳转 */
	public function qqAuth() {
		require_once ("./qq/qqConnectAPI.php");
		$qc = new QC ();
		$qc->qq_login ();
	}
	/**
	 * 需要session中第三方登录获取信息支持
	 *
	 *
	 *
	 * @access public
	 * @param        	
	 *
	 * @return void
	 * @author zhangcheng
	 */
	public function account() {
		// 根据类型进行参数重置
		/*
		 * 姓名 头像 第三方标示ID access_token / openid type
		 */
		
		// 绑定账号
		//dump($_SESSION);
		// dump($_COOKIE);
		
		// 设置不可返回
		$_SESSION ['has_login_by_social'] = 1;
		$type = "baidu";
		// 分配 第三方登录 标识
		switch ($_REQUEST["ltype"]) {
			case 'baidu' :
				$type = "baidu";
				break;
			case 'qq' :
				$type = "qq";
				break;
			case 'sina' :
				$type = "sina";
				break;
			case 'github':
				$type = "github";
				break;
		}

		// 查询是否已经绑定过帐号

		$User = M ("User" );
		$result = $User->where("{$type}={$_SESSION['Auth']['Social']['userid']}")->find();
		
		if ($result) {
			// 进行登录操作
			
			$_SESSION ['Auth'] ['name'] = $result ['name'];
			$_SESSION ['Auth'] ['id'] = $result ['id'];
			$_SESSION ['Auth'] ['username'] = $result ['username'];//邮箱
			$_SESSION ['Auth'] ['login_type'] = $type;
			
			header ( "location:http://www." . $_SERVER ["SERVER_NAME"] . "/index/index.html" );
			exit ();
		}

		// 未绑定
		//dump($_SESSION);
		$this->assign ( "type", $type );
		$this->assign ( "username", $_SESSION ['Auth'] ['Social'] ['username'] );
		$this->assign ( "avatar_img", $_SESSION ['Auth'] ['Social'] ['avatar_img'] );
		
		$this->display ();
	}

	public function github() {
		if ($_SESSION ['has_login_by_social'] == 1) {
			

			cookie ( null );
			session ( null );
			
			header ( "location:".NET_NAME );
			exit ();
		}

		if($_REQUEST['code']){
			$url = "https://github.com/login/oauth/access_token";
			$data['client_id'] = "c1d05cc24f15c5dfb7ce";
			$data['redirect_uri']=urlencode(NET_NAME."/social/github");
			$data['client_secret'] = "086b65793c9e409f8d6464fb1e692703dee2c4fa";
			$data['code'] = $_REQUEST['code'];

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
			$_SESSION ['Auth'] ['Social'] ['avatar_img'] = $response ['avatar_url'];
			
			$_SESSION ['Auth'] ['Social'] ['type'] = 'github';
			$_SESSION ['Auth'] ['Social'] ['username'] = $response ['login'];
			$_SESSION ['Auth'] ['Social'] ['email'] = $response ['email'];
			$_SESSION ['Auth'] ['Social'] ['userid'] = $response ['id'];
			$_SESSION ['Auth'] ['Social'] ['access_token'] = $access_token[1];
			$_SESSION ['Auth'] ['Social'] ['code'] = $_REQUEST['code'];
			
			header ( "location:".NET_NAME. "/social/account.html?ltype=github" );

			exit;
	    }

		dump($_REQUEST);
	}

	public function github2()
	{
		if ($_SESSION ['has_login_by_social'] == 1) {

			cookie ( null );
			session ( null );
			header ( "location:http://www." . $_SERVER ["SERVER_NAME"] );
			exit ();
		}

		$url = "https://github.com/login/oauth/authorize?";
		$data['client_id'] = "c1d05cc24f15c5dfb7ce";
		$data['redirect_uri']=urlencode(NET_NAME."/social/github");
		$data['scope'] = "user,user:email,public_repo";
		$data['state'] = "zc";
		foreach ($data as $key => $value) {
			$url .= ($key."=".$value."&");
		}

		$url = rtrim($url,'&');

		header ( "location:".$url );
	}

	/**
	 * 战网登陆
	 */
	public function battle()
	{
		if ($_SESSION ['has_login_by_social'] == 1) {

			cookie ( null );
			session ( null );
			header ( "location:https://" . $_SERVER ["HTTP_HOST"] );
			exit ();
		}

		$url = "https://www.battlenet.com.cn/oauth/authorize?";
		$data['client_id'] = "qj64g7amth6m79kzax8tf76kuq35tfzn";
		$data['redirect_uri']=urlencode(NET_NAME."/social/battle_callback");
		$data['scope'] = "wow.profile";
		$data['state'] = "zc";
		$data['response_type'] = 'code';
		foreach ($data as $key => $value) {
			$url .= ($key."=".$value."&");
		}

		$url = rtrim($url,'&');

		header ( "location:".$url );
	}


	/**
	 * battle token
	 * https://www.battlenet.com.cn/oauth/token
	 */
	public function battle_callback()
	{
		if ($_SESSION ['has_login_by_social'] == 1) {


			cookie ( null );
			session ( null );

			header ( "location:https://" . $_SERVER ["HTTP_HOST"] );
			exit ();
		}
		//dump($_REQUEST);// code state
		//exit;

		if($_REQUEST['code']){
			$url = "https://www.battlenet.com.cn/oauth/token";
			$data['client_id'] = "qj64g7amth6m79kzax8tf76kuq35tfzn";
			$data['redirect_uri']=urlencode(NET_NAME."/social/battle_callback");
			$data['client_secret'] = "EWUYUzp2hCFDtXqUHmFAbGMZ6rEbaMyV";
			$data['scope'] = "wow.profile";
			$data['code'] = $_REQUEST['code'];
			$data['grant_type'] = 'authorization_code';
			$curlPost = '';

			foreach ($data as $key => $value) {
				$curlPost .= ($key.'='.$value.'&');
			}
			$curlPost = rtrim($curlPost,'&');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,1);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
			$data = curl_exec($ch);


			curl_close($ch);
			dump(json_decode($data,true));
			exit;
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
			$_SESSION ['Auth'] ['Social'] ['avatar_img'] = $response ['avatar_url'];

			$_SESSION ['Auth'] ['Social'] ['type'] = 'github';
			$_SESSION ['Auth'] ['Social'] ['username'] = $response ['login'];
			$_SESSION ['Auth'] ['Social'] ['email'] = $response ['email'];
			$_SESSION ['Auth'] ['Social'] ['userid'] = $response ['id'];
			$_SESSION ['Auth'] ['Social'] ['access_token'] = $access_token[1];
			$_SESSION ['Auth'] ['Social'] ['code'] = $_REQUEST['code'];

			header ( "location:".NET_NAME. "/social/account.html?ltype=github" );

			exit;
		}

		dump($_REQUEST);
	}
}
