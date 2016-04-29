<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/29
 * Time: 14:58
 */

namespace app\index\controller;

use think\Controller;

class Error extends Controller
{
    public function index()
    {
        return 404;
    }

    public function _empty()
    {
        return 404;
    }

}