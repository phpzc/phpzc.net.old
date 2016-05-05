<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/15
 * Time: 14:55
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\CommonController as AhcCommonController;

class CommonController extends AhcCommonController
{
    public function __construct()
    {
    }

    protected function dump($str)
    {
        echo "<pre>";

        var_dump($str);
        echo "</pre>";
    }
}