<?php

/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2015/12/18
 * Time: 0:15
 */
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function _empty()
    {
        exit('404');
    }

    public function checkLogin()
    {
        if( session('?uid') == false){
            redirect('/index/login');
        }

    }


    public function index()
    {


        if(IS_GET){
            $this->checkLogin();

            $this->display();
        }else{
            $username = I('post.username');
            $password = I('post.password');

            if($username == '1091796360@qq.com' && $password =='qaz159357'){
                session('username',$username);
                session('uid',1);
            }
            $this->checkLogin();

            $this->display();
        }

    }

    public function login()
    {
        layout(false);
        $this->display();
    }


}