<?php
namespace App\Action;

class IndexAction extends CommonAction {
	public function index() {
		
		$c = M ( 'Category' );
		$r = $c->where ( "pid=0" )->select ();
		
		$article = M ( "Article" );
		$res = $article->where ( "isdel=0" )->order ( "id desc" )->limit ( 5 )->select ();
		
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

		$article_num = $article->where("isdel=0" )->count();
		$article_view = $article->sum('visit');


		$article = M ( "Document" );
		$all = $article->where ( "isdel=0" )->order ( "id desc" )->limit (4)->select ();
		
		$this->assign ( "article_list2", $all );

		$document_num = $article->count();
		$document_view = $article->sum('visit');
		/*$this->assign('data',array(
			'id'=>1,
			'username'=>'peak',
		));*/

		//分配 文章 文档 图片的数量
		$photo = M("Photo");
		$photo_num = $photo->count();
		$photo_view = $photo->sum('visit');
		$this->assign('site_count',array('article'=>$article_num,'article_view'=>$article_view,
				'document'=>$document_num,'document_view'=>$document_view,
				'photo'=>$photo_num,'photo_view'=>$photo_view));
		//分配图片信息
		$lunbo = M('index')->where('status=1')->order('id desc')->limit(3)->select();
		$this->assign('lunbo',$lunbo);

		//分配友情链接
		$link = M('Links');
		$links = $link->where('status!=0')->select();
		$this->assign('links',$links);

		$this->display ();
	}

}
