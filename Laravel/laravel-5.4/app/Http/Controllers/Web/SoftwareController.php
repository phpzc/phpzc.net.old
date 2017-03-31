<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/28
 * Time: 下午5:44
 */

namespace App\Http\Controllers\Web;


class SoftwareController
{

    const TYPE_GUI = 0;
    const TYPE_GAME = 1;

    /*
     * @brief 设置每一页标题
     */
    public function _initialize() {
        parent::_initialize ();
        $action_name = strtolower ( ACTION_NAME );
        switch ($action_name) {
            case 'index' :
                $this->assign ( "website_title", "软件" );
                break;
            case 'create' :
                $this->assign ( "website_title", "发布软件" );
                break;
            case 'update' :
                $this->assign ( "website_title", "修改软件" );
                break;
        }
    }
    // 遍历列表 前20个软件
    public function index() {
        $page = I('get.page',1,'int');

        $limit = 10;
        $result = M('software')->page($page,$limit)->select();
        $count = M('software')->count();
        $page = new \Think\Page($count,$limit);
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display ();
    }

    // 创建软件
    public function create() {
        if(IS_GET){
            $this->display();
        }else{
            $data = I('post.');
            $data['soft_image'] = json_encode($data['mortgaged-img-url'],true);
            $data['develop_log'] = htmlspecialchars_decode($data['develop_log']);
            $data['description_simple'] = htmlspecialchars_decode($data['description_simple']);
            $data['description'] = htmlspecialchars_decode($data['description']);
            $data['create_time'] = date('Y-m-d H:i:s');
            $model =  M('software');
            if( $model->create($data) ){
                if($model->add()){
                    $type = $data['type'] == 0 ? 'gui':'game';

                    $this->formSuccess('添加成功','/software/'.$type);
                }else{
                    $this->formErrorReferer('添加失败');
                }
            }else{
                $this->formError($model->getError());
            }
        }

    }
    // 更新软件
    public function update() {
        if(IS_GET){
            $this->display();
        }else{
            $data = I('post.');
            $data['soft_image'] = json_encode($data['mortgaged-img-url'],true);
            $data['develop_log'] = htmlspecialchars_decode($data['develop_log']);
            $data['description_simple'] = htmlspecialchars_decode($data['description_simple']);
            $data['description'] = htmlspecialchars_decode($data['description']);
            $data['update_time'] = date('Y-m-d H:i:s');
            //var_dump($data);
            $model =  M('software');
            if( false === $model->where(array('id'=>$data['id']))->save($data) ){
                $type = $data['type'] == 0 ? 'gui':'game';
                $this->formSuccess('更新成功','/software/'.$type.'/id/'.$data['id']);

            }else{
                $this->formErrorReferer('更新失败');
            }
        }

    }

    // 删除软件
    public function del() {

        $id = I('get.id',0,'int');
        $data = M('software')->where(array('id'=>$id))->find();
        $res = M('software')->where(array('id'=>$id))->delete();

        $type = $data['type'] == 0 ? 'gui':'game';

        if($res){
            $this->formSuccess('删除成功','/software/'.$type);

        }else{
            $this->formError('删除失败','/software/'.$type);
        }
    }


//	public function search() {
//	}


    public function gui()
    {
        $page = I('get.page',1,'int');

        $limit = 10;
        $result = M('software')->where(array('type'=>self::TYPE_GUI))->page($page,$limit)->select();
        $count = M('software')->where(array('type'=>self::TYPE_GUI))->count();
        $page = new \Think\Page($count,$limit);
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('result',$result);

        $this->assign('soft_type','gui');

        $this->assign ( "website_title", "桌面程序" );

        $this->display ();
    }


    public function game()
    {
        $page = I('get.page',1,'int');

        $limit = 10;
        $result = M('software')->where(array('type'=>self::TYPE_GAME))->page($page,$limit)->select();
        $count = M('software')->where(array('type'=>self::TYPE_GAME))->count();
        $page = new \Think\Page($count,$limit);
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->assign('soft_type','game');
        $this->assign ( "website_title", "游戏程序" );
        $this->display ();
    }


    public function guidetail()
    {
        $id = I('get.id',0,'int');

        $data = $result = M('software')->where(array(
            'id'=>$id
        ))->find();

        if(empty($data)){
            $this->_empty();
        }
        $this->assign('soft_type','gui');
        $data['soft_image'] = json_decode($data['soft_image']);

        $this->assign('data',$data);
        $this->assign ( "website_title", '[GUI]'.$data['title'] );
        $this->display();
    }

    public function gamedetail()
    {
        $id = I('get.id',0,'int');

        $data = $result = M('software')->where(array(
            'id'=>$id
        ))->find();

        if(empty($data)){
            $this->_empty();
        }
        $data['soft_image'] = json_decode($data['soft_image']);

        $this->assign('soft_type','game');
        $this->assign('data',$data);
        $this->assign ( "website_title", '[GAME]'.$data['title'] );
        $this->display();
    }


}