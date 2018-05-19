<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/8
 * Time: 下午2:19
 */

namespace App\Http\Controllers\Web;


class WebAuthController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('WebAuth');
    }

}