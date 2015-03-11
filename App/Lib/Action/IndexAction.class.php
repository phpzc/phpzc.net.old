<?php
//
class IndexAction extends CommonAction {
	public function index() {
		// $a = parse_ini_file("test.ini",true);
		// dump($a);
		//
		//
		// dump($_SERVER);
		$c = M ( 'Category' );
		$r = $c->where ( "pid=0" )->select ();
		
		$article = M ( "Article" );
		$res = $article->where ( "isdel=0" )->order ( "id desc" )->limit ( 3 )->select ();
		
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
		
		$article = M ( "Document" );
		$all = $article->where ( "isdel=0" )->order ( "id desc" )->limit ( 3)->select ();
		
		$this->assign ( "article_list2", $all );
		$this->display ();
	}
}
