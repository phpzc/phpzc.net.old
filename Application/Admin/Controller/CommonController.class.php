<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2016/1/3
 * Time: 13:04
 */

namespace Admin\Controller;


use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
        $this->assign('THIS_CONTROLLER',CONTROLLER_NAME);
        $this->assign('THIS_ACTION',ACTION_NAME);
    }

    protected function actionReturn($status,$msg = '',$data=null){
        $response = array('status'=>$status,'msg'=>$msg);
        if(is_string($data)){
            $response['url']=$data;
        }elseif(!empty($data)){
            $response['data'] = $data;
        }
        $this->ajaxReturn($response);

    }
}