<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:43
 */

namespace App\Http\Controllers\Web;


use App\Model\Article;
use App\Model\Category;
use App\Model\Document;
use App\Model\Links;
use App\Model\Index;

use App\Service\CacheService;

class IndexController extends CommonController
{

    public final function index()
    {

        $func = \Closure::bind(function(){

            $category = session('website.category');

            $res = Article::where('isdel',0)->orderBy('id','desc')->limit(8)->get()->toArray();

            foreach ( $res as $k => $v ) {
                $res [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );

                $res [$k] ["id"] = encodeId ( $v ['id'] );
            }

            $all = Document::where('isdel','0')->orderBy('id','desc') ->limit(6)->get()->toArray();

            $lunbo = Index::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->limit(3)->get()->toArray();

            $links = Links::where('status','!=',0)->get()->toArray();

            return [
                'category'=>$category,
                'article_list' => $res,
                'article_list2' => $all,
                'lunbo' => $lunbo,
                'links' => $links,
            ];

        },null);


        $data = CacheService::IndexController_index($func);


        $this->assign ( 'article_list', $data['article_list'] );

        $this->assign ( 'category', $data['category'] );

        $this->assign ( 'article_list2', $data['article_list2'] );

        $this->assign('lunbo',$data['lunbo']);

        $this->assign('links',$data['links']);

        $this->assign('website_title','首页');


        return view('index.index');
    }
}