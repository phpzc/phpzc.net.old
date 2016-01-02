<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2016/1/2
 * Time: 14:11
 */

namespace App\Action;


class DownloadAction extends CommonAction
{
    public function index()
    {
        $url = I('get.url','');

        if(empty($url)){
            redirect('/');
        }

        $type = strtolower(I('get.type','')) ;
        $id = I('get.id',0,'int');

        switch($type){
            case 'document':
                $this->document($url,$id);
                break;
            case 'picture':
                $this->picture($url,$id);
                break;
            default:
                redirect('/');
                break;
        }
    }

    private function document($url,$id){
        $model = M('document');

        if($model->where(array('id'=>$id))->setInc('visit',1) === false){
            redirect('/');
        }else{
            header('location:'.$url);
        }
    }

    private function picture($url,$id){
        $model = M('picture');

        if($model->where(array('id'=>$id))->setInc('visit',1) === false){
            redirect('/');
        }else{
            header('location:'.$url);
        }
    }
}