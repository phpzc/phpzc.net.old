<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:41
 */

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        $this->_init();
    }

    public function _init()
    {
        //子类实现自身方法
    }

}