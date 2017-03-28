<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:43
 */

namespace App\Http\Controllers\Web;


class FormController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('website_title','提示信息');
    }

    public final function success() {

        // 标题
        $title = request()->input('title');
        // 跳转页面
        $url = request()->input('url');
        $sec = request()->input('sec');
        $this->assign ( "title", $title );
        $this->assign ( "url", base_decode($url) );
        $this->assign ( "sec", $sec );

        return view('form.success');
    }
    
    public final function error() {
        // 标题
        $title = request()->input('title');
        // 跳转页面
        $url = request()->input('url');
        $sec = request()->input('sec');
        $this->assign ( "title", $title );
        $this->assign ( "url", base_decode($url) );
        $this->assign ( "sec", $sec );

        return view('form.error');
    }
}