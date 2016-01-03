<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2015/12/22
 * Time: 0:21
 */

namespace Admin\Controller;

class LinksController extends CommonController
{

    public function index()
    {
        $model = M('Links');

        $res = $model->select();

        $this->assign('links',$res);
        $this->display();
    }

    public function del()
    {
        $id = I('get.id');
        $model = M('Links');

        $res = $model->where(array('id'=>$id))->delete();

        if($res){
            $this->success('删除成功','/Links/index');
        }else{
            $this->error('删除失败','/Links/index');
        }
    }


    public function edit()
    {
        if(IS_GET){
            $id = I('get.id');
            $model = M('Links');
            $res = $model->where(array('id'=>$id))->find();
            if($res){
                $this->assign('links',$res);
                $this->display();
            }else{
                $this->error('不存在','/Links/index');
            }
        }else{

            $data = I('post.');
            $model = M('Links');
            $res = $model->save($data);
            if($res === false){
                $this->error('保存失败','/Links/index');
            }else{
                $this->success('保存成功','/Links/index');
            }
        }
    }



}