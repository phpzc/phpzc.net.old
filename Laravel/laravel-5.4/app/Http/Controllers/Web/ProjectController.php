<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:43
 */

namespace App\Http\Controllers\Web;


use App\Model\Article;
use App\Model\Project;
use App\Model\ProjectSummary;

class ProjectController extends CommonController
{
    public function _initialize() {
        parent::_initialize();
        $action_name = strtolower ( ACTION_NAME );
        switch ($action_name) {
            case 'index' :
            case 'project_index':
                $this->assign ( 'bread_crumbs', 'List Project' );
                $this->assign('website_title','Project List');
                break;
            case 'create' :
                $this->assign('website_title','Project Create');

                $this->assign ( 'bread_crumbs', 'Create Project' );
                break;
            case 'add_article':
                $this->assign('website_title','Project Add Article');
                break;
            default:
                $this->assign('website_title','Project');
                break;
        }
    }


    public final function index()
    {
        $this->formRootLoginCheck();
        $allProject = Project::all()->toArray();

        $this->assign('project',$allProject);

        return view('project.index');
    }

    public final function detail()
    {

        $article_id = request()->input('id');

        $article_data = Article::where(['id'=>$article_id])
            ->first();

        if(empty($article_data)){
            $this->formError('Article not found');
        }

        $article_data = $article_data->toArray();

        if(empty($article_data['project_id']))
        {
            $this->formError('Article is not sub of project');
        }

        //assign project menu
        if( !request()->session()->has('project_detail_tmp_menu')) {
            $allProject = Project::all()->toArray();

            foreach ($allProject as $k => $v2) {

                $summary = ProjectSummary::where('project_id', $v2['project_id'])->get()->toArray();

                foreach ($summary as $k2 => $v) {

                    if (!$v['article_id_data']) {

                        $summary[ $k2 ]['sub_data'] = [];
                        continue;
                    }

                    $tmp = explode(',', $v['article_id_data']);
                    if (in_array($article_id, $tmp)) {
                        $summary[ $k2 ]['class_active'] = 1;
                    } else {
                        $summary[ $k2 ]['class_active'] = 0;
                    }

                    $subData = Article::whereIn('id', explode(',', $v['article_id_data']))->select('title', 'id')->get()->toArray();
                    $summary[ $k2 ]['sub_data'] = $subData;
                }

                $allProject[ $k ]['summary'] = $summary;

            }

            request()->session()->put('project_detail_tmp_menu', $allProject);
        }
        //dump($allProject);
        $this->assign('MENU_PROJECT',session('project_detail_tmp_menu'));

        //assign this project id
        $this->assign('THIS_PROJECT_ID',$article_data['project_id']);


        //assign article data
        $this->assign('this_id',$article_id);

        // 搜索文章
        $res = Article::where(['article.id'=>$article_id])
            ->join('user','user.id','=','article.uid')
            ->select('article.*','user.name')
            ->first();

        if ($res) {

            $res = $res->toArray();

            $res ['title'] = htmlspecialchars_decode ( $res ['title'] );
            $res ['content'] = htmlspecialchars_decode ( $res ['content'] );
            $this->assign ( 'article', $res );

            Article::where(['id'=>$article_id])->increment('visit');

            $cid = explode('-',$res['bpath']);
            $this->assign('this_category', $cid[1]);

            $this->assign('website_title',$res ["title"]);

            return view('project.detail');
        } else {
            abort(404);
        }
    }

    public final function create()
    {
        $this->formRootLoginCheck();

        return view('project.create');
    }

    public final function create_project()
    {
        $this->formRootLoginCheck();
        $name = request()->input('name');
        if(!empty($name)){

            $add = Project::insertGetId(['name'=>$name]);

            if($add) {
                $this->formSuccess('Project Add Success','project/create');
            }else {
                $this->formErrorReferer('Project Add Error');
            }
        }else {
            $this->formErrorReferer("Project name can not empty");
        }

    }


    public final function project_add_subject()
    {
        $this->formRootLoginCheck();

        if(request()->isMethod('post')) {
            $data = $_POST;

            $project = Project::where(['project_id'=>$data['project_id']])->first();

            if(empty($project))
            {
                $this->formErrorReferer('Data not found');
            }

            $add = ProjectSummary::insertGetId($data);
            if($add)
            {
                $this->formSuccess('Data Save Success','project/index');
            }else{
                $this->formErrorReferer('Data Save Fail');
            }
        }else{
            $project_id = request()->input('id');

            $this->assign('project_id',$project_id);

            return view('project.project_add_subject');
        }
    }

    public final function project_remove_subject()
    {
        $this->formRootLoginCheck();

        $id = request()->input('id');
        $articleId = request()->input('aid');

        $summary = ProjectSummary::where(['id'=>$id])->first();
        if(!$summary){
            abort(404);
        }
        $summary = $summary->toArray();
        $data = explode(',',$summary['article_id_data']);
        foreach($data as $k=>$v)
        {
            if($v == $articleId){
                unset($data[$k]);
                break;
            }
        }

        $summary['article_id_data'] = join(',',$data);

        $save = ProjectSummary::where(['id'=>$summary['id']])
            ->update($summary);
        if($save ===false)
        {
            $this->formErrorReferer('Data no save');
        }else{
            $this->formSuccess('save success','project/project_index?id='.$summary['project_id']);
        }
    }

    public final function project_index()
    {
        $this->formRootLoginCheck();

        $project_id = request()->input('id',1);

        $summary = ProjectSummary::where(['project_id'=>$project_id])->get()->toArray();


        foreach($summary as $k=>$v)
        {
            if(!$v['article_id_data']){
                $summary[$k]['sub_data'] = [];
                continue;
            }

            $subData = Article::whereIn('id',explode(',',$v['article_id_data']))->select('id','title')->get();

            $subData = $subData->toArray();
            $summary[$k]['sub_data'] = $subData;
        }

        $this->assign('summary',$summary);


        $this->assign('project',Project::where(['project_id'=>$project_id])->first()->toArray());

        return view('project.project_index');
    }


    public final function add_article()
    {
        $this->formRootLoginCheck();
        $porject_id = request()->input('project_id');

        $id = request()->input('id');
        if( request()->isMethod('post'))
        {
            $summary = ProjectSummary::where(['id'=>$id])->first();
            if(empty($summary)){
                abort(404);
            }
            $summary = $summary->toArray();

            $arr = explode(',',$summary['article_id_data']);
            if(empty($arr) or empty($arr[0]))
            {
                $arr = array();
            }

            array_push($arr, request()->input('article_id'));
            $arr = array_unique($arr);
            $summary['article_id_data'] = join(',',$arr);

            $update =ProjectSummary::where(['id'=>$id])->update($summary);

            if($update!==false)
            {
                //设置文章的project id
                $update_article_pid = Article::where(array('id'=>request()->input('article_id')))
                    ->update(array('project_id'=>$porject_id));

                $this->formSuccess('update success','project/project_index?id='.$porject_id);
            }else{
                $this->formErrorReferer('update error');
            }
        }
        else
        {
            $articles = Article::where(
                array('isdel'=>0,'project_id'=>0)
            )->select('id','title')->get();
            $this->assign('article',$articles->toArray());

            return view('project.add_article');
        }
    }
}