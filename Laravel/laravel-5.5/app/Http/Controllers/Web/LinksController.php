<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/29
 * Time: 下午2:48
 */

namespace App\Http\Controllers\Web;


use App\Model\Links;

class LinksController extends CommonController
{
    public final function add()
    {
        $data['email'] = request()->input('email');
        $data['url'] = request()->input('url');
        $data['name'] = request()->input('name');

        $link = new Links();
        $link->email = $data['email'];
        $link->url = $data['url'];
        $link->name = $data['name'];
        $link->add_time = date('Y-m-d H:i:s');
        $link->status = 0;
        try{
            $link->save();

            return '1';
        }
        catch (\Exception $e)
        {
            return '0';
        }

    }
}