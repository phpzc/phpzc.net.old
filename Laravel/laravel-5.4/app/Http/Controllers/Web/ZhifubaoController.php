<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/8/23
 * Time: 下午3:00
 */

namespace App\Http\Controllers\Web;


class ZhifubaoController extends CommonController
{
    public final function callback()
    {
        var_dump(request()->all());

        return 'success';
    }

}