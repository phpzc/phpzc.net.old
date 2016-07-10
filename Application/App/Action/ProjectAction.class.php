<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/7/4
 * Time: 下午4:51
 */

namespace App\Action;


class ProjectAction extends CommonAction
{
    public function _initialize() {
        parent::_initialize();
        $action_name = strtolower ( ACTION_NAME );
        switch ($action_name) {
            case 'index' :
                $this->assign ( 'bread_crumbs', 'List Project' );
                break;
            case 'create' :
                $this->assign ( 'bread_crumbs', 'Create Project' );
                break;
        }
    }


    public function index()
    {
        $this->formRootLoginCheck();
        $allProject = M('project')->select();

        $this->assign('project',$allProject);

        $this->display();

    }
    
    public function project_add_subject()
    {
        $this->formRootLoginCheck();

        if(IS_POST) {
            $data = I('post.');
            $project = M('project')->where(array('project'=>$data['project_id']))->find();

            if(empty($project))
            {
                $this->formErrorReferer('Data not found');
            }

            $add = M('project_summary')->add($data);
            if($add)
            {
                $this->formSuccess('Data Save Success','project/index');
            }else{
                $this->formErrorReferer('Data Save Fail');
            }
        }else{
            $project_id = I('get.id');
            
            
            $this->assign('project_id',$project_id);
            $this->display();
        }
    }

    public function project_remove_subject()
    {
        $this->formRootLoginCheck();

        $id = I('get.id');
        $articleId = I('get.aid');

        $summary = M('project_summary')->where("project_id={$id}")->find();
        if(!$summary){
            $this->_empty();
        }

        $data = explode(',',$summary['article_id_data']);
        foreach($data as $k=>$v)
        {
            if($v == $articleId){
                unset($data[$k]);
                break;
            }
        }

        $summary['article_id_data'] = join(',',$data);

        $save = M('project_summary')->save($summary);

        if($save ===false)
        {
            $this->formErrorReferer('Data no save');
        }else{
            $this->formSuccess('save success','project/project_index/id/'.$summary['project_id']);
        }
    }

    public function project_index()
    {
        $this->formRootLoginCheck();

        $project_id = I('get.id',1,'int');

        $summary = M('project_summary')->where("project_id={$project_id}")->select();
        $article = M('article');

        foreach($summary as &$v)
        {
            if(!$v['article_id_data']){
                $v['sub_data'] = [];
                continue;
            }
            $subData = $article->where('id in ('.$v['article_id_data'].')')->field('id,title')->select();
            $v['sub_data'] = $subData;
        }

        $this->assign('summary',$summary);
        
        
        $this->assign('project',M('project')->where("project_id={$project_id}")->find());
        $this->display();
    }

    public function create()
    {
        $this->formRootLoginCheck();

        $this->display();
    }

    public function create_project()
    {
        $this->formRootLoginCheck();
        $name = I('post.name');
        if(!empty($name)){
            $add = M('project')->add(array('name'=>$name));

            if($add) {
                $this->formSuccess('Project Add Success','project/create');
            }else {
                $this->formErrorReferer('Project Add Error');
            }
        }else {
            $this->formErrorReferer("Project name can not empty");
        }

    }

    /**
     *
     */
    public function detail()
    {
        $article_id = I('get.id');

        $article_data = M('article')->where(array('id'=>$article_id))->find();
        if(empty($article_data)){
            $this->formError('Article not found');
        }

        if(empty($article_data['project_id']))
        {
            $this->formError('Article is not sub of project');
        }

        //assign project menu
        $allProject = M('project')->select();

        $article = M('article');
        foreach ($allProject as &$v2)
        {
            $summary = M('project_summary')->where("project_id={$v2['project_id']}")->select();

            foreach($summary as &$v)
            {
                if(!$v['article_id_data']){
                    $v['sub_data'] = [];
                    continue;
                }

                $tmp = explode(',',$v['article_id_data']);
                if(in_array($article_id,$tmp))
                {
                    $v['class_active'] = 1;
                }else{
                    $v['class_active'] = 0;
                }

                $subData = $article->where('id in ('.$v['article_id_data'].')')->field('id,title')->select();
                $v['sub_data'] = $subData;


            }

            $v2['summary'] = $summary;
        }
        //dump($allProject);
        $this->assign('MENU_PROJECT',$allProject);

        //assign this project id
        $this->assign('THIS_PROJECT_ID',$article_data['project_id']);


        //assign article data
        $this->assign('this_id',$article_id);



        // 搜索文章
        $article = M ( "Article" );

        $res = $article->query ( "select a.*,u.name from vip_article as a,vip_user as u where a.uid = u.id and a.id={$article_id}" );

        $res = $res [0];
        if ($res) {
            $res ["title"] = htmlspecialchars_decode ( $res ["title"] );
            $res ["content"] = htmlspecialchars_decode ( $res ["content"] );
            $this->assign ( 'article', $res );

            //更新文章访问量
            $article->where('id='.$article_id)->setInc('visit');
            $cid = explode('-',$res['bpath']);
            $this->assign('this_category', $cid[1]);
            $this->display ();
        } else {
            $this->_empty ();
        }
    }


    public function add_article()
    {
        $this->formRootLoginCheck();
        $porject_id = I('request.project_id');
        $id = I('request.id');
        if(IS_POST)
        {
            $summary = M('project_summary')->where("id={$id}")->find();
            if(empty($summary)){
                $this->_empty();
            }

            $arr = explode(',',$summary['article_id_data']);
            if(empty($arr) or empty($arr[0]))
            {
                $arr = array();
            }

            array_push($arr,I('post.article_id'));
            $arr = array_unique($arr);
            $summary['article_id_data'] = join(',',$arr);

            $update = M('project_summary')->where("id={$id}")->save($summary);

            if($update!==false)
            {
                $this->formSuccess('update success','project/project_index/id/'.$porject_id);
            }else{
                $this->formErrorReferer('update error');
            }
        }
        else
        {
            $articles = M('article')->where(
                array('is_del'=>0,'project_id'=>array('eq',0))
            )->field('id,title')->select();
            $this->assign('article',$articles);
            $this->display();
        }
    }
}