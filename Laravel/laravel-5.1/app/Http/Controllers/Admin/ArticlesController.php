<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 16:52
 */

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;

class ArticlesController extends AuthController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $articles = Article::where('isdel','!=',1)
            ->orderBy('id','desc')->paginate(10000);

        return view('admin.articles.index',['articles'=>$articles,
        'active'=>'articles']);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Article::where('id',$id)->update(
            array('isdel'=>1)
        );

        if($del){
            return $this->jump('Article del success!', '/admin/articles/index');

        }else{
            return back();
        }
    }

    public function getMonth(Request $request)
    {
        $start = $request->input('start',0);
        $end = $request->input('end',0);

        $start /= 1000;
        $end /= 1000;
        if(empty($start)){
            $start = strtotime(date('Y-m-01'));
            $end = strtotime(date('Y-m-t'));
        }

        $result = Article::whereBetween('time',[$start,$end])->get();

        $newArray = [];
        foreach ($result as $v){
            $v = $v->toArray();
            $v['day'] = (int)date('d',$v['time']);
            $v['month'] = (int)$v['month'];
            $v['url'] = NET_NAME.'/article/detail/id/'.$this->encodeId($v['id']).'.html';

            $newArray[] = $v;
        }

        return json_encode(['data'=>$newArray],true);
    }
}