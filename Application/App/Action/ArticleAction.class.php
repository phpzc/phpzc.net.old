<?php
namespace App\Action;
class ArticleAction extends CommonAction {
	// 遍历列表 前20个文章
	public function index() {
		$article = M ( "Article" );
		$all = $article->where ( "isdel=0" )->count ();
		import ( "ORG.Util.Page" ); // 导入分页类
		$page = new Page ( $all, 8 );
		$page->setConfig ( 'header', '篇文章' );
		$page->setConfig ( 'prev', 'Prev Page' );
		$page->setConfig ( 'next', 'Next Page' );
		$show = $page->show ();
		
		$res = $article->query ( "select a.id,a.title,a.content,a.bpath,a.time,a.month,a.year,u.name from vip_article as a,vip_user as u where a.isdel = 0 and a.uid = u.id order by a.id desc limit {$page->firstRow},{$page->listRows}" );
		foreach ( $res as $k => $v ) {
			$res [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );
			$res [$k] ["imgurl"] = findImageUrl ( $v ['content'] );
			$res [$k] ["id"] = $this->encodeId ( $v ['id'] );
			if ($res [$k] ["imgurl"] == ""){
				$res [$k] ["imgurl_class"] = getCategoryClassName($res [$k] ["bpath"]);
			}
		}
		$this->assign ( "article_list", $res );
		$this->assign ( "article_page", $show );
		$this->assign ( "website_title", "所有文章" );
		$this->display ();
	}
	
	// 创建文章
	public function create() {
		// 登录检测
		$this->formLoginCheck ();
		
		$this->display ();
	}
	
	// 处理新增
	public function dealCreate() {
		$this->formLoginCheck ();
		// 组织数据
		
		$data ["title"] = htmlspecialchars ( $_REQUEST ["form_title"] );
		$data ["content"] = htmlspecialchars ( $_REQUEST ["form_article"] );
		
		$this->fieldLengthCheck ( $data ["title"], "文章标题", 100 );
		//$this->fieldLengthCheck ( $data ["content"], "文章内容", 10000 );
		
		$data ["time"] = time ();
		$data ["uid"] = $_SESSION ["Auth"] ["id"];
		$pid = $_REQUEST ["form_category"];
		$category = M ( 'Category' );
		$info = $category->where ( array (
				"id" => $pid 
		) )->field ( 'path' )->find ();
		if (! $info) {
			$this->formErrorReferer ( "非法操作" );
		}
		
		$data ['bpath'] = $info ['path'] . '-' . $pid;
		$data ['year'] = date ( 'Y', $data ['time'] );
		$data ['month'] = date ( 'm', $data ['time'] );
		$data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
		$article = M ( 'Article' );
		$res = $article->add ( $data );
		
		if ($res) {
			// 标签管理添加
			$key = A ( 'Keyword' );
			$key->automake ( $res, $_REQUEST ["form_tag"], 'article' );
			$this->formSuccess ( "创建文章", "/article/create.html" );
		} else {
			$this->formErrorReferer ( "创建文章" );
		}
	}
	public function edit() {
		$this->formLoginCheck ();
		$article = M ( "Article" );
		$id = $this->_get ( "id" );
		$id = $this->decodeId ( $id );
		$res = $article->where ( array (
				"id" => $id 
		) )->find ();
		
		if (! $res || $res ["uid"] != $_SESSION ["Auth"] ["id"]) {
			$this->formError ( "文章不存在", "/index/index.html" );
		}
		// category id
		$category = explode ( '-', $res ["bpath"] );
		$category = $category [1];
		// dump($category);
		$this->assign ( "categoryid", $category );
		// 标签
		$key = A ( 'Keyword' );
		$this->assign ( "keyword", $key->getCategoryString ( "article", $res ["id"] ) );
		$res ["content"] = htmlspecialchars_decode ( $res ["content"] );
		$this->assign ( "article", $res );
		$this->display ();
	}
	
	/**
	 * 更新文章 无法更新标签
	 */
	public function update() {
		$this->formLoginCheck ();
		$article = M ( 'Article' );
		
		// 组织数据
		$data ["uid"] = $_SESSION ["Auth"] ["id"];
		
		$id = $this->decodeId($_REQUEST ["article_id"]);
		$res1 = $article->where ( array (
				"id" => $id 
		) )->field ( "uid" )->find ();
		if (! $res1 || $res1 ["uid"] != $data ["uid"]) {
			$this->formError ( "非法操作", "/index/index.html" );
		}
		
		$data ["id"] = $id;
		$data ["title"] = htmlspecialchars ( $_REQUEST ["form_title"] );
		$data ["content"] = htmlspecialchars ( $_REQUEST ["form_article"] );
		
		$this->fieldLengthCheck ( $data ["title"], "标题", 100 );
		//$this->fieldLengthCheck ( $data ["content"], "文章内容", 10000 );

		$pid = $_REQUEST ["form_category"];
		$category = M ( 'Category' );
		$info = $category->where ( array (
				"id" => $pid 
		) )->field ( 'path' )->find ();
		if (! $info) {
			$this->formErrorReferer ( "非法操作" );
		}
		$data ['bpath'] = $info ['path'] . '-' . $pid;
		
		$res = $article->data ( $data )->save ();
		
		if ($res) {
			// 标签管理添加
			$key = A ( 'Keyword' );
			$key->updateCategory ( "article", $id, $_REQUEST ["form_tag"] );
			$this->formSuccess ( "修改文章", "/article/mylist.html" );
		} else {
			$this->formErrorReferer ( "修改文章" );
		}
	}
	
	// 删除文章
	public function del() {
		$this->formLoginCheck ();
		// 删除标签数量
		// 删除文章
		
		$id = ( int ) $this->_get ( "id" );
		$id = $this->decodeId ( $id );
		
		$article = M ( 'Article' );
		$res = $article->where ( "id={$id} and uid={$_SESSION["Auth"]["id"]}" )->field ( "id" )->find ();
		
		if ($res) {
			$data ["isdel"] = 1;
			$data ["id"] = $id;
			$article->data ( $data )->save ();
			$this->formSuccess ( "删除成功", "/article/mylist.html" );
		} else {
			$this->formErrorReferer ( "没有此文章" );
		}
	}
	
	// 查找文章
	public function search() {
		$category = ( int ) $_GET ["category"]; // id
		$tag = ( int ) $_GET ["tag"];
		if ($category > 0) {
			$CT = M ( "Category" );
			$res = $CT->where ( array (
					"id" => $category 
			) )->field ( "path" )->find ();
			
			$path = $res ["path"] . "-" . $category;
			
			$article = M ( "Article" );
			$count = $article->where ( "isdel = 0 and bpath like '" . $path . "%' " )->count ();
			if ($count > 0) {
				import ( "ORG.Util.Page" ); // 导入分页类
				$page = new Page ( $count, 8 );
				$page->setConfig ( 'header', '篇文章' );
				$page->setConfig ( 'prev', 'Prev Page' );
				$page->setConfig ( 'next', 'Next Page' );
				$show = $page->show ();
				
				$res = $article->query ( "select a.id,a.title,a.content,a.time,a.month,a.bpath,a.year,u.name from vip_article as a,vip_user as u where a.uid = u.id and a.isdel = 0 and  a.bpath like '" . $path . "%' order by a.time desc limit {$page->firstRow},{$page->listRows}" );
				
				if (! $res) {
					$this->formErrorReferer ( "没有搜索到文章" );
				}
				foreach ( $res as $k => $v ) {
					$res [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );
					$res [$k] ["imgurl"] = findImageUrl ( $v ['content'] );
                    $res [$k] ["id"] = $this->encodeId ( $v ['id'] );
                    if ($res [$k] ["imgurl"] == ""){
				        $res [$k] ["imgurl_class"] = getCategoryClassName($res [$k] ["bpath"]);
			        }
				}
				$this->assign ( "website_title", "搜索文章结果-" );
				$this->assign ( "article_list", $res );
				$this->assign ( "article_page", $show );
				$this->assign ( "count", $count );
				$this->display ();
			} else {
				$this->formErrorReferer ( "没有搜索到文章" );
			}
		} elseif ($tag > 0) {
			$CT = M ( "Articlekeyword" );
			$res = $CT->where ( array (
					"kid" => $tag 
			) )->field ( "realid" )->select ();
			
			$cnt = count ( $res );
			// dump($res);
			// exit();
			$where = "";
			if ($cnt < 1) {
				$this->formErrorReferer ( "没有搜索到文章" );
			} elseif ($cnt < 2) {
				// 1
				$where = "id=" . $res [0] ["realid"];
			} else {
				// 2 more
				$where .= 'id in (';
				foreach ( $res as $v ) {
					$where .= $v ["realid"] . ',';
				}
				$where = trim ( $where, "," );
				$where .= ')';
			}
			
			$article = M ( "Article" );
			$result = $article->where ( "isdel = 0 and " . $where )->select ();
			
			if (! $res) {
				$this->formErrorReferer ( "没有搜索到文章" );
			}
			foreach ( $result as $k => $v ) {
				$result [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );
				$result [$k] ["imgurl"] = findImageUrl ( $v ['content'] );
                $result [$k] ["id"] = $this->encodeId ( $v ['id'] );
                if ($res [$k] ["imgurl"] == ""){
				    $res [$k] ["imgurl_class"] = getCategoryClassName($res [$k] ["bpath"]);
			    }
			}
			$this->assign ( "article_list", $result );
			
			$this->assign ( "count", count ( $result ) );
			$this->display ();
		} else {
			
			$this->formErrorReferer ( "没有搜索到文章" );
		}
	}
	
	// 详情页
	public function detail() {
		$id = $this->_get ( "id" );
		if (empty ( $id )) {
			$this->_empty ();
		}
		
		$id = $this->decodeId ( $id );
		// 搜索文章
		$article = M ( "Article" );
		
		$res = $article->query ( "select a.id,a.title,a.content,a.time,a.month,a.year,u.name from vip_article as a,vip_user as u where a.uid = u.id and a.id={$id}" );
		
		$res = $res [0];
		if ($res) {
			$res ["title"] = htmlspecialchars_decode ( $res ["title"] );
			$res ["content"] = htmlspecialchars_decode ( $res ["content"] );
			$this->assign ( 'article', $res );
			$this->assign ( 'article_pre', $this->predata ( $id ) );
			$this->assign ( 'article_next', $this->nextdata ( $id ) );
			
			$this->display ();
		} else {
			$this->_empty ();
		}
	}
	
	// 我的文章
	public function mylist() {
		$this->formLoginCheck ();
		
		$article = M ( "Article" );
		$all = $article->where ( "uid={$_SESSION["Auth"]["id"]} and isdel = 0" )->count ();
		import ( "ORG.Util.Page" ); // 导入分页类
		$page = new Page ( $all, 15 );
		$page->setConfig ( 'header', '篇文章' );
		$page->setConfig ( 'prev', 'Prev Page' );
		$page->setConfig ( 'next', 'Next Page' );
		$show = $page->show ();
		
		$res = $article->query ( "select a.id,a.title,a.content,a.bpath,a.time,a.month,a.year,u.name from vip_article as a,vip_user as u where a.isdel = 0 and u.id ={$_SESSION["Auth"]["id"]} and a.uid = u.id order by a.id desc limit {$page->firstRow},{$page->listRows}" );
		
		foreach ( $res as $k => $v ) {
			$res [$k] ["content"] = strip_tags ( htmlspecialchars_decode ( $v ['content'] ) );
			$res [$k] ["imgurl"] = findImageUrl ( $v ['content'] );
			$res [$k] ["id"] = $this->encodeId ( $v ['id'] );
			if ($res [$k] ["imgurl"] == ""){
				$res [$k] ["imgurl_class"] = getCategoryClassName($res [$k] ["bpath"]);
			}
		}
		$this->assign ( "article_list", $res );
		$this->assign ( "article_page", $show );
		$this->assign ( "website_title", "我的文章" );
		$this->display ();
	}
	
	// 文章收藏
	public function mycollect() {
		$this->formLoginCheck ();
	}
	
	//访问量增加
	public function addvisit()
	{
		$id = $this->_post("id");
		$article = M ( "Article" );
		$res = $article->where(array("id"=>$id))->field("id,visit")->find();
		if($res){
			$data["id"] = $id;
			$data["visit"] = $res["visit"] + 1;
			$article->data($data)->save();
		}		
	}
	
	
	/*
	 * @param $id 当前数据id @param $table 搜索的表 @return 返回上一条数据的字符串
	 */
	public function predata($id) {
		$model = M ( 'Article' );
		$maxid = $model->order ( 'id desc' )->limit ( 1 )->field ( 'id' )->find ();
		$id = $id + 1;
		$array = array ();
		while ( true ) {
			$result = $model->where ( 'id=' . $id . ' and isdel = 0 ' )->field ( 'id,title' )->find ();
			if ($result) {
				$array ["id"] = $this->encodeId ( $id );
				$array ["title"] = $result ["title"];
				break;
			}
			$id ++;
			if ($id > $maxid ['id']) {
				
				break;
			}
		}
		return $array;
	}
	
	/*
	 * @param $id 当前数据id @param $table 搜索的表 @return 返回下一条数据的字符串
	 */
	public function nextdata($id) {
		$model = M ( "Article" );
		
		$id = $id - 1;
		$maxid = $model->order ( 'id desc' )->limit ( 1 )->field ( 'id' )->find ();
		$array = array ();
		while ( true ) {
			$result = $model->where ( 'id=' . $id . ' and isdel = 0' )->find ();
			if ($result) {
				$array ["id"] = $this->encodeId ( $id );
				$array ["title"] = $result ["title"];
				break;
			}
			$id --;
			if ($id < 1) {
				
				break;
			}
		}
		return $array;
	}
}
