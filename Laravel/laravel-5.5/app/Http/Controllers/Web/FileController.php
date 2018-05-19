<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:43
 */

namespace App\Http\Controllers\Web;

class FileController extends CommonController
{

    public final function cat()
    {
        $file = request()->input('file');

        $prefix = '/project/';

        $filename = $prefix . $file;

        if( file_exists($filename)){

            $content = file_get_contents($filename);

            $this->assign('title',$file);
            $this->assign('content',$content);
            $this->assign ( "website_title", "源码分析:". $file);

            return view('file.cat');
        }else{
            abort(404);
        }

    }
}