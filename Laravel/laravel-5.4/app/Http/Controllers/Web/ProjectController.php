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

    public final function index()
    {

    }

    /**
     *
     */
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
        $allProject = Project::all()->toArray();

        foreach ($allProject as &$v2)
        {

            $summary = ProjectSummary::where(['project_id'=>$v2['project_id']])->get()->toArray();

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

                $subData = Article::where('id','in',$tmp)->select('id','title')->get();
                if($subData){
                    $subData = $subData->toArray();
                }
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


}