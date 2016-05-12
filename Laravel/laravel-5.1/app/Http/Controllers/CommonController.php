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
    function __construct()
    {
        
        if(method_exists($this,'_init')){
            $this->_init();
        }
    }


    public function __call($method, $parameters)
    {
        abort(404);
    }



    public function _init()
    {

    }

}