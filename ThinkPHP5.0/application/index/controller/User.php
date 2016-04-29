<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/29
 * Time: 17:03
 */

namespace app\index\controller;

use app\index\model\UserModel;
/*
 * 数据库长度限制 username 32 password 32 name 32
 */
class User extends Base
{

    /*
     * 登录错误码 设置 error_code 0 用户名或者密码缺失 1 账号不存在 2 密码不正确 3 非法操作 非本网站登录进来的
     */
    public function login() {
        $error_code = array ();

        /*
        if ($_POST ["code"] != $_SESSION ["form"] ["code"]) {
            $error_code = array (
                    "error_code" => 3,
                    "error_str" => "非法操作"
            );
            echo json_encode ( $error_code );
            exit ();
        }
        */

        $email = I('post.email','string');
        $password = I( 'post.password','string' );

        $res = UserModel::where ( array (
            'username' => $email
        ) )->find ();
        if (! $res) {

            if(!IS_AJAX){
                redirect('/user/login_page');
                exit;
            }

            $error_code = array (
                "error_code" => 1,
                "error_str" => "账号不存在"
            );
        } else {

            if ($res ['password'] == md5 ( $password )) {
                // 登录操作初始化session、
                $_SESSION ['Auth'] ['name'] = $res ['name'];
                $_SESSION ['Auth'] ['id'] = $res ['id'];
                $_SESSION ['Auth'] ['username'] = $res ['username'];
                // if($this->_post('auto') == 1){
                // cookie
                // setCookie("",);
                // }
                if(!IS_AJAX){

                    if($_POST['remember'] == '1')
                    {
                        cookie('email',$res ['username']);
                        cookie('password',$password);
                    }else{
                        cookie('email',null);
                        cookie('password',null);
                    }

                    redirect('/');
                    exit;
                }

                $error_code = array (
                    "success" => "1"
                );
            } else {
                if(!IS_AJAX){
                    redirect('/user/login_page');
                    exit;
                }


                $error_code = array (
                    "error_code" => 2,
                    "error_str" => "密码不正确"
                );
            }
        }

        return json_encode ( $error_code );
    }
    /*
     * 注册错误码 设置 error_code 0 用户名或者密码缺失 1 账号存在 2 昵称重复 3 非法操作 非本网站进来的
     */
    public function reg() {
        $error_code = array ();

        /*
        if ($_POST ["code"] != $_SESSION ["form"] ["code"]) {
            $error_code = array (
                    "error_code" => 3,
                    "error_str" => "非法操作"
            );
            echo json_encode ( $error_code );
            exit ();
        }
        */


        $email = I('post.email','string');
        $password = md5 ( I('post.password','string') );
        $name = htmlspecialchars ( I( 'post.name','string' ) );
        if(empty($email) OR empty($password)){
            if(!IS_AJAX){
                redirect('/user/register_page');
                return;
            }
            $error_code = array (
                "error_code" => 3,
                "error_str" => "数据不存在"
            );
            return json_encode ( $error_code );

        }
        // 长度

        $res = UserModel::where ( array (
            "username" => $email
        ) )->field ( 'id' )->find ();
        if ($res) {
            if(!IS_AJAX){
                redirect('/user/register_page');
                return;
            }

            $error_code = array (
                "error_code" => 1,
                "error_str" => "账号已存在"
            );
            return json_encode ( $error_code );

        }

        $res2 = UserModel::where ( array (
            "name" => $name
        ) )->field ( 'id' )->find ();

        if ($res2) {
            if(!IS_AJAX){
                redirect('/user/register_page');
                exit;
            }

            $error_code = array (
                "error_code" => 2,
                "error_str" => "昵称重复"
            );
            return json_encode ( $error_code );

        }

        $ip = ip2long ( $_SERVER ["REMOTE_ADDR"] );
        $time = time ();

        $r = UserModel::data ( array (
            "username" => $email,
            "password" => $password,
            "name" => $name,
            "regip" => $ip,
            "regtime" => $time
        ) )->save();

        if ($r) {

            $res = UserModel::where('username',$email)->find();
            // 登录操作初始化session、
            $_SESSION ['Auth'] ['name'] = $name;
            $_SESSION ['Auth'] ['id'] = $res['id'];
            $_SESSION ['Auth'] ['username'] = $name;

            if(!IS_AJAX){
                redirect('/');
                exit;
            }

            $error_code = array (
                "success" => "1"
            );
        } else {

            if(!IS_AJAX){
                redirect('/user/register_page');
                exit;
            }

            $error_code = array (
                "error_code" => 4,
                "error_str" => "数据添加失败"
            );
        }

        return json_encode ( $error_code );
    }

    /*
     * @brief 第三方登录 注册新用户 V1 注册版
     */
    public function accountBindNew() {

        $_SESSION ['has_login_by_social'] = 0;

        $error_code = NULL;

        if ($_POST ["code"] != $_SESSION ["form"] ["code"]) {
            $error_code = array (
                "error_code" => 1,
                "error_str" => "非法操作"
            );
            return json_encode ( $error_code );

        }

        // 检测帐号
        $username = I( "post.username" );

        $result = UserModel::where ( array (
            "username" => $username
        ) )->field ( "id" )->find ();

        if ($result) {
            $error_code = array (
                "error_code" => 2,
                "error_str" => "邮箱已注册"
            );
            return json_encode ( $error_code );

        }

        $data ["username"] = I( "post.username" );
        $data ["password"] = md5 ( I( "post.password" ) );
        $data ["name"] = htmlspecialchars ( I( "post.name" ) );

        $res2 = UserModel::where ( array (
            "name" => $data ["name"]
        ) )->field ( 'id' )->find ();

        if ($res2) {
            $error_code = array (
                "error_code" => 3,
                "error_str" => "昵称重复"
            );
            return json_encode ( $error_code );

        }

        $data ['regip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
        $data ['regtime'] = time ();

        //添加 第三方登陆标记
        $data [I( 'post.type')] = $_SESSION ['Auth'] ['Social'] ['userid'];

        $r = UserModel::data ( $data )->save();

        if ($r) {
            $res = UserModel::where('username',$data ["username"])->find();
            // 登录操作初始化session、
            $_SESSION ['Auth'] ['name'] = $data ["name"];
            $_SESSION ['Auth'] ['id'] = $res['id'];
            $_SESSION ['Auth'] ['username'] = $username;
            $_SESSION ['Auth'] ['login_type'] = I( "post.type" );

            $error_code = array (
                "success" => "1"
            );
        } else {
            $error_code = array (
                "error_code" => 4,
                "error_str" => "数据添加失败"
            );
        }

        return json_encode ( $error_code );
    }

    /*
     * @brief 第三方登录 已有帐号绑定验证 V1 注册版 错误码 1 非法操作 2 用户不存在 3 密码不正确
     */
    public function accountBindOld() {
        $error_code = NULL;

        if (I( 'post.code' ) != $_SESSION ["form"] ["code"]) {
            $error_code = array (
                "error_code" => 1,
                "error_str" => "非法操作code"
            );
            return json_encode ( $error_code );

        }

        // 检测帐号
        $username = I( "post.username" );

        $result = UserModel::where ( array (
            "username" => $username
        ) )->find ();

        if (! $result) {
            $error_code = array (
                "error_code" => 2,
                "error_str" => "用户不存在"
            );
            return json_encode ( $error_code );

        }

        if ($result ["password"] != md5 ( I( "post.password" ) )) {
            $error_code = array (
                "error_code" => 3,
                "error_str" => "密码不正确"
            );
            return json_encode ( $error_code );

        }

        $array = array (
            "qq",
            "sina",
            "baidu",
            "github"
        );

        if (! in_array ( I( 'post.type' ), $array )) {
            $error_code = array (
                "error_code" => 5,
                "error_str" => "非法操作"
            );
        }

        if (! empty ( $result [I( 'post.type' )] )) {
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
        $data ["id"] = $result ["id"];
        $data [I( 'post.type' )] = $_SESSION ['Auth'] ['Social'] ['userid'];
        $res = UserModel::where ( array (
            "id" => $data ["id"]
        ) )->save ( $data );

        if ($res) {
            $error_code = array (
                "success" => 1
            );

            // 登录操作初始化session、
            $_SESSION ['Auth'] ['name'] = $result ['name'];
            $_SESSION ['Auth'] ['id'] = $result ['id'];
            $_SESSION ['Auth'] ['username'] = $result ['username'];
            $_SESSION ['Auth'] ['login_type'] = I( "post.type" );

            return json_encode ( $error_code );
        } else {
            $error_code = array (
                "error_code" => 6,
                "error_str" => "数据库更新失败"
            );
            return json_encode ( $error_code );

        }
    }

    /*
     * @brief 退出
     */
    public function logout() {
        //cookie ( null );
        session ( null );
        redirect ( 'http://' . $_SERVER ['HTTP_HOST'] );
    }

    /*
     *
     *
     */
    public function login_page()
    {
        $this->view->engine->layout(false);
        return $this->fetch('User/login');
    }

    public function register_page()
    {
        $this->view->engine->layout(false);
        return $this->fetch('User/register');
    }
    //忘记密码


    //验证激活码


    //发邮件发验证码



}