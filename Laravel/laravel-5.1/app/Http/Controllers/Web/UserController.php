<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/8
 * Time: 下午2:25
 */

namespace App\Http\Controllers\Web;


class UserController extends CommonController
{
    public function getLogin()
    {
        return 'login';
    }

    public function getLogout()
    {

        request()->session()->regenerate(true);

        return redirect('/');
    }
}