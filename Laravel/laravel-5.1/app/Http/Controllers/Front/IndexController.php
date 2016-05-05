<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/15
 * Time: 14:54
 */

namespace App\Http\Controllers\Front;

class IndexController extends CommonController
{
    
    public function __construct()
    {
        parent::__construct();

        //分配中间件
        //$this->middleware('test',['only'=>['uselayout']]);//zhi

    }

    public function index()
    {
        echo __METHOD__;
        $data = [
            'a'=>213,
            'b'=>213213123,
        ];
        return view('Front.Index.index',$data);
    }

    public function uselayout()
    {

        //取得此方法路由地址
        $url = action('Front\IndexController@uselayout');
        //echo $url;
        

        return view('Front.Index.uselayout',['xss'=>'<h3>aaaa</h3>']);
    }

    public function use2()
    {
        echo 2;
    }
}