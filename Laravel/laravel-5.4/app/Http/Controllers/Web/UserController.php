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


class UserController extends CommonController
{
    public $user_service;


    public final function login_page(Request $request)
    {

        if( 'GET' == request()->method())
        {
            return view('user.login');
        }else{

            $this->user_service = new UserService();

            $username = $request->input('username');
            $password = $request->input('password');

            $loginResult = $this->user_service->login($username,$password);

            if($loginResult)
            {
                redirect('/');
            }else{

                return view('user.login');
            }
        }
    }

}