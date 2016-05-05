<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/15
 * Time: 14:43
 */

namespace App\Http\Controllers;


class CommonController extends Controller
{

    public function __call($method, $parameters)
    {
        abort(404);
    }
}