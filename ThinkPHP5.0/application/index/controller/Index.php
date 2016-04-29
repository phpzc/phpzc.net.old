<?php
namespace app\index\controller;
use app\index\model\ArticleModel as Article;
use app\index\model\CategoryModel as Category;
use app\index\model\DocumentModel as Document;
use app\index\model\PhotoModel as Photo;
use app\index\model\LinksModel as Links;

class Index extends Base
{
    public function index()
    {

        $r = Category::where ( "pid=0" )->select ();

        $res = Article::where ( "isdel=0" )->order ( "id desc" )->limit ( 5 )->select ();

        foreach ( $res as $k => $v ) {
            $res [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );
            $res [$k] ["imgurl"] = findImageUrl ( $v ['content'] );
            if ($res [$k] ["imgurl"] == ""){
                $res [$k] ["imgurl_class"] = getCategoryClassName($res [$k] ["bpath"]);
            }
            $res [$k] ["id"] = $this->encodeId ( $v ['id'] );
        }

        $this->assign ( "article_list", $res );

        $this->assign ( 'category', $r );


        $article_num = Article::where("isdel=0" )->count();

        $article_view = Article::sum('visit');


        $all = Document::where ( "isdel=0" )->order ( "id desc" )->limit (4)->select ();

        $this->assign ( "article_list2", $all );

        $document_num = Document::count();
        $document_view = Document::sum('visit');
        /*$this->assign('data',array(
            'id'=>1,
            'username'=>'peak',
        ));*/

        //分配 文章 文档 图片的数量

        $photo_num = Photo::count();
        $photo_view = Photo::sum('visit');
        $this->assign('site_count',array('article'=>$article_num,'article_view'=>$article_view,
            'document'=>$document_num,'document_view'=>$document_view,
            'photo'=>$photo_num,'photo_view'=>$photo_view));


        //分配友情链接
        $links = Links::where('status!=0')->select();
        $this->assign('links',$links);


        return $this->fetch();
    }




    public function index_bak()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
}
