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


    /*
    * 加密id
    */
    protected function encodeId($id) {
        $mid = md5 ( $id );
        $str = substr ( $mid, 0, 16 );
        $str .= $id;
        $str .= substr ( $mid, 16, 16 );
        return $str;
    }
    /*
     * 解密id
     */
    protected function decodeId($id) {
        $len = strlen ( $id );
        $str = substr ( $id, 16, $len - 32 );
        return $str;
    }
}