<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/15
 * Time: 17:07
 */
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
/**
 * 隐式控制器 路由自动定义
 * Class SimpleController
 * @package App\Http\Controllers\Front
 */
class SimpleController extends CommonController
{
    public function getIndex()
    {
        echo __METHOD__;
    }

    public function postAdd()
    {
        echo __METHOD__;
    }

    public function getParam(Request $request,$id)
    {
        echo $id;
    }

    public function getRequest(Request $request)
    {
        dump($request->ajax());
        dump($request->path());
        dump($request->url());
        dump($request->isMethod('get'));

        dump($request->input('aaa',1));
        dump($request->input('post.0.a','222'));

        dump($request->all());
        dump($request->old('a'));
        $request->flash();

        dump($request->cookie());

        cookie('test',123,1800);
        $response = new  \Illuminate\Http\Response('test');

        return $response->withCookie('test','123',60);

    }
}