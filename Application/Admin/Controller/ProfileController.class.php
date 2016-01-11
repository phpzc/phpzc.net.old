<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2016/1/3
 * Time: 11:45
 */

namespace Admin\Controller;


use Think\Controller;

class ProfileController extends CommonController
{
    public function index()
    {
        $model = M('profile');

        $info = $model->find();
        dump($info);
        $this->assign('info',$info);

        $this->display();
    }

    public function create()
    {
        if(IS_GET){

            $this->display();
        }else{
            $data = I('post.');
            $model = M('profile');
            $result = $model->add($data);

            if($result){
                $this->actionReturn(1,'success','/Profile/index');
            }else{
                $this->actionReturn(0,'error');
            }

        }
    }

    public function edit()
    {
        if(IS_GET){
            $model = M('profile');

            $info = $model->where(array('id'=>1))->find();
            $this->assign('info',$info);
            $this->display();
        }else{

            $data = I('post.');
            $model = M('profile');
            $data['begin_time'] = strtotime($data['begin_time']);
            $res = $model->save($data);
            if($res === false){
                $this->error('保存失败','/Links/index');
            }else{
                $this->success('保存成功','/Links/index');
            }

        }
    }
}