<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午11:16
 */

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Service\UserService;
use App\Model\User;
use Illuminate\Support\Facades\Cookie;


class UserController extends CommonController
{
    public $user_service;


    public final function login_page(Request $request)
    {

        if( 'GET' == request()->method())
        {

            return view('user.login',['username'=>Cookie::get('username','') ,'password'=>Cookie::get('password','')]);
        }else{

            $this->user_service = new UserService();

            $username = $request->input('username');
            $password = $request->input('password');

            $loginResult = $this->user_service->login($username,$password);

            if($loginResult)
            {

                return response('<script>location.href="/";</script>')
                    ->header('Content-Type', 'text/html')
                    ->cookie('username', $username,7*24*3600 )
                    ->cookie('password', $password,7*24*3600 );
            }else{

                return view('user.login');
            }
        }
    }

    public final function logout()
    {
        request()->session()->flush();
        request()->session()->regenerate(true);

        return redirect('/');
    }

    public final function register_page()
    {
        return view('user.register');
    }

    /**
     *
     * 注册错误码 设置 error_code 0 用户名或者密码缺失 1 账号存在 2 昵称重复 3 非法操作 非本网站进来的
     *
     */
    public final function reg() {


        $email = request()->input('email');
        $password = md5 ( request()->input('password'));

        $name = htmlspecialchars ( request()->input('name'));
        if(empty($email) OR empty($password)){
            if(! is_ajax()){
                return redirect('/user/register_page');
            }

        }
        // 长度

        $res = User::where ( array (
            'username' => $email
        ) )->select ( 'id' )->first();

        //用户存在
        if ($res) {
            if(!is_ajax()){
                return redirect('/user/register_page');

            }
        }

        $res2 = User::where ( array (
            'name' => $name
        ) )->select ( 'id' )->first();

        if ($res2) {
            if(!is_ajax()){
                return redirect('/user/register_page');

            }

        }

        $ip = ip2long ( get_client_ip(0,true) );
        $time = time ();

        $r = User::insertGetId( array (
            'username' => $email,
            'password' => $password,
            'name' => $name,
            'regip' => $ip,
            'regtime' => $time
        ) );

        if ($r) {
            // 登录操作初始化session、
            session(['name'=>$name]);
            session(['id'=>$r]);
            session(['username'=>$name]);

            if(!is_ajax()){
                return redirect('/');

            }

        } else {

            if(!is_ajax()){
                return redirect('/user/register_page');

            }

        }

    }


    /**
     * @brief 第三方登录 注册新用户 V1 注册版
     */
    public final function accountBindNew() {

        session(['has_login_by_social'=>0]);

        $error_code = NULL;

        // 检测帐号
        $username = request()->input('username');

        $result = User::where ( array (
            'username' => $username
        ) )->select ( "id" )->first ();

        if ($result) {
            $error_code = array (
                "error_code" => 2,
                "error_str" => "邮箱已注册"
            );
            echo json_encode ( $error_code );
            exit ();
        }

        $data ['username'] = request()->input('username');
        $data ['password'] = md5 ( request()->input( 'password' ) );
        $data ['name'] = htmlspecialchars ( request()->input('name')  );

        $res2 = User::where ( array (
            'name' => $data ['name']
        ) )->select ( 'id' )->first();

        if ($res2) {
            $error_code = array (
                "error_code" => 3,
                "error_str" => "昵称重复"
            );
            echo json_encode ( $error_code );
            exit ();
        }

        $data ['regip'] = ip2long ( get_client_ip(0,true) );
        $data ['regtime'] = time ();

        //添加 第三方登陆标记
        $data [ request()->input('type')] = session('userid');

        $r = User::insertGetId( $data );

        if ($r) {
            // 登录操作初始化session
            session(['name'=>$data ['name']]);
            session(['id'=>$r]);
            session(['username'=>$username]);
            session(['login_type'=>request()->input('type')]);

            $error_code = array (
                'success' => 1
            );
        } else {
            $error_code = array (
                'error_code' => 4,
                'error_str' => '数据添加失败'
            );
        }

        echo json_encode ( $error_code );
    }


    /**
     * @brief 第三方登录 已有帐号绑定验证 V1 注册版 错误码 1 非法操作 2 用户不存在 3 密码不正确
     */
    public final function accountBindOld() {
        $error_code = NULL;

        // 检测帐号
        $username = request()->input('username');

        $result = User::where ( array (
            'username' => $username
        ) )->first();

        if (! $result) {
            $error_code = array (
                "error_code" => 2,
                "error_str" => "用户不存在"
            );
            echo json_encode ( $error_code );
            exit ();
        }
        $result = $result->toArray();

        if ($result ['password'] != md5 ( request()->input('password')) ) {
            $error_code = array (
                "error_code" => 3,
                "error_str" => "密码不正确"
            );
            echo json_encode ( $error_code );
            exit ();
        }

        $array = array (
            "qq",
            "sina",
            "baidu",
            "github"
        );

        if (! in_array ( request()->input('type'), $array )) {
            $error_code = array (
                "error_code" => 5,
                "error_str" => "非法操作"
            );
        }

        if (! empty ( $result [ request()->input('type') ] )) {
            $error_code = array (
                "error_code" => 4,
                "error_str" => "不能绑定已经绑定的帐号"
            );
        }

        if ($error_code != NULL) {
            echo json_encode ( $error_code );
            exit ();
        }

        // 绑定第三方登录标识 跳转登录 首页
        $data ['id'] = $result ['id'];
        $data [request()->input('type')] = session('userid');
        $res = User::where ( array (
            'id' => $data ['id']
        ) )->update( $data );

        if ($res) {
            $error_code = array (
                "success" => 1
            );
            echo json_encode ( $error_code );

            // 登录操作初始化session、
            session(['name'=>$result ['name']]);
            session(['id'=>$result ['id']]);
            session(['username'=>$result ['username']]);
            session(['login_type'=>request()->input('type')]);


            exit ();
        } else {
            $error_code = array (
                "error_code" => 6,
                "error_str" => "数据库更新失败"
            );
            echo json_encode ( $error_code );
            exit ();
        }
    }


    //忘记密码
    public final function forgot_password_page()
    {
        return view('user.forgot_password_page');
    }

    //验证并修改密码
    public final function verify_code()
    {
        //修改密码页和提交页

        if(request()->isMethod('POST'))
        {
            $email =  request()->input('username');
            $new_pwd = request()->input('password');
            $code = request()->input('code');

            $user=User::where(array('username'=>$email))->first();
            if(empty($user)){
                $this->formError('用户不存在','user/login_page');
            }
            $user=$user->toArray();

            $verify_code = md5($user['password']);
            $codeArr = explode('_',$code);
            if(time() > $codeArr[1])
            {
                $this->formError('修改邮件超时','user/login_page');
            }
            if($codeArr[0] != $verify_code)
            {
                $this->formError('验证码失败','user/login_page');
            }

            $update=User::where(array('username'=>$email))->update(array(
                'username'=>$email,
                'password'=>md5($new_pwd),
            ));

            if($update !== false)
            {
                $this->formSuccess('修改成功','user/login_page');
            }else{
                $this->formError('修改失败','user/login_page');
            }

        }else{
            $email = base_decode(request()->input('username'));
            $user=User::where(array('username'=>$email))->first();
            if(empty($user)){
                $this->formError('用户不存在','user/login_page');
            }

            $this->assign('username',$email);
            $this->assign('code',request()->input('code','0_0'));


            return view('user.verify_code');
        }



    }


    //发邮件发验证码
    public final function forgot_password_send_mail()
    {
        $email = request()->input('email');

        $time = (int) session('send_email_number');
        if($time > 20){
            die("can not send too many emails");
        }
        session(['send_email_number'=> $time + 1]);

        //查询用户是否存在
        $user=User::where(array('username'=>$email))->first();
        if(empty($user)){
            $this->formError('用户不存在','user/login_page');
        }else{
            $user = $user->toArray();
            $verify_code = md5($user['password']).'_'.(time()+3600);
            $body = '密码找回地址'.NET_NAME.'/user/verify_code?code='.$verify_code.'&username='.base_encode($email);

            $send = send_email($email,$user['name'],'忘记密码——找回密码邮件',$body);

            return $this->formSuccess($send?"发送成功":"发送失败",'/');
        }


    }

}