<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/1/4
 * Time: 下午10:46
 */

namespace App\Action;


class FileAction extends CommonAction
{
    public function index()
    {
        dump($_GET);
    }


    public function cat()
    {
        $file = I('get.file','');

        $prefix = '/project/';

        $filename = $prefix . $file;

        if( file_exists($filename)){

            $content = file_get_contents($filename);

            $this->assign('title',$file);
            $this->assign('content',$content);

            $this->display();
        }else{
            $this->_empty();
        }

    }
}