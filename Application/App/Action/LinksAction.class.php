<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2015/12/21
 * Time: 0:17
 */

namespace App\Action;


class LinksAction extends CommonAction
{


    public function add()
    {
        $data['email'] = I('post.email');
        $data['url'] = I('post.url');
        $data['name'] = I('post.name');
        $data['add_time'] = date('Y-m-d H:i:s');

        $links = M('Links');

        if(!$links->create($data)){
            echo 0;
        }else{
            $id = $links->add();
            echo 1;
        }



    }

}