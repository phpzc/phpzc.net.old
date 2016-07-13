<?php
namespace App\Action;
class DocumentAction extends CommonAction {
	/*
	 * @brief 设置每一页标题
	 */
	public function _initialize() {
		parent::_initialize ();
		$action_name = strtolower ( ACTION_NAME );
		switch ($action_name) {
			case 'index' :
				$this->assign ( "website_title", "文档" );
				break;
			case 'create' :
				$this->assign ( "website_title", "新增资料-" );
				break;
			case 'edit' :
				$this->assign ( "website_title", "更新资料-" );
				break;
			case 'mylist' :
				$this->assign ( "website_title", "我的资料-" );
				break;
			case 'search' :
				$this->assign ( "website_title", "搜索文档结果-" );
				break;
		}
	}
	
	// 遍历列表 前20个文档资料
	public function index() {
		$article = M ( "Document" );
		// $res = $article->limit(20)->order('id desc')->select();
		// $res = $article->query("select * from ( select * from vip_article
		// order by id desc limit 20) a inner join vip_user u on a.uid = u.id");
		$all = $article->where ( "isdel=0" )->count ();
		import ( "ORG.Util.Page" ); // 导入分页类
		$page = new \Think\Page ( $all, 8 );
		$page->setConfig ( 'header', '篇资料' );
		$page->setConfig ( 'prev', 'Prev Page' );
		$page->setConfig ( 'next', 'Next Page' );
		$show = $page->show ();
		
		$res = $article->query ( "select a.id,a.visit,a.title,a.author,a.imgurl,a.url,a.bpath,a.urltype,a.doctype,a.content,a.time,a.month,a.year,u.name from vip_document as a,vip_user as u where a.isdel = 0 and a.uid = u.id order by a.id desc limit {$page->firstRow},{$page->listRows}" );
		
		$this->assign ( "article_list", $res );
		$this->assign ( "article_page", $show );
		$this->display ();
	}
	public function detail() {
		$this->display ();
	}
	
	// 创建文档资料
	public function create() {
		$this->formLoginCheck ();
		$this->display ();
	}
	public function dealCreate() {
		$this->formLoginCheck ();
		// 表单处理
		$length = 0;
		$length = getLength ( $_POST ['form_title'] );
		if ($length > 100) {
			$this->formErrorReferer ( "标题长度不能超过100个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "标题不能为空" );
		}
		$length = getLength ( $_POST ['form_author'] );
		if ($length > 100) {
			$this->formErrorReferer ( "作者长度不能超过100个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "作者不能为空" );
		}
		$length = getLength ( $_POST ['url'] );
		if ($length > 200) {
			$this->formErrorReferer ( "网盘地址长度不能超过200个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "网盘地址不能为空" );
		}
		
		$data ["content"] = htmlspecialchars ( $_POST ["form_article"] );
		$length = getLength ( $_POST ['form_article'] );
		if ($length > 10000) {
			$this->formErrorReferer ( "内容长度不能超过10000个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "内容不能为空" );
		}
		
		// 图片上传处理
		import ( 'ORG.Net.UploadFile' );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = 1024 * 1024 * 10; // 设置附件上传大小
		$upload->allowExts = array (
				'jpg',
				'png',
				'jpeg' 
		); // 设置附件上传类型
		$upload->thumb = true;
		$upload->thumbMaxWidth = '50,280';
		$upload->thumbMaxHeight = '50,280';
		// 取得当前用户的id 获取资料封面图片上传目录
		$dir = './Public/Uploads/document/' . md5 ( $_SESSION ['Auth'] ['id'] ) . '/';
		if (! is_dir ( $dir )) {
			@mkdir ( $dir );
		}
		$upload->savePath = $dir; // 设置附件上传目录
		$info = "";
		if (! $upload->upload ()) { // 上传错误提示错误信息
		                         // $this->error($upload->getErrorMsg());
		                         // dump($upload->getErrorMsg());
		                         // exit();
			$this->formErrorReferer ( "文件上传不成功" );
		} else { // 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo ();
			dump ( $info );
		}
		
		$imgurl = 'http://' . $_SERVER ['SERVER_NAME'] . '/Public/Uploads/document/' . md5 ( $_SESSION ['Auth'] ['id'] ) . '/thumb_' . $info [0] ['savename'];
		// 原图删除 留下280X280
		@unlink ( $dir . $info [0] ['savename'] );
		// 组织数据
		
		$data ["title"] = htmlspecialchars ( $_REQUEST ["form_title"] );
		
		$data ["author"] = htmlspecialchars ( $_REQUEST ["form_author"] );
		$data ["imgurl"] = $imgurl;
		$data ["urltype"] = ( int ) $_POST ["urltype"];
		$data ["doctype"] = ( int ) $_POST ["doctype"];
		$data ["url"] = htmlspecialchars ( $_REQUEST ["url"] );
		$data ["time"] = time ();
		$data ["uid"] = $_SESSION ["Auth"] ["id"];
		$pid = $_REQUEST ["form_category"];
		$category = M ( 'Category' );
		$info = $category->where ( 'id=' . $pid )->field ( 'path' )->find ();
		$data ['bpath'] = $info ['path'] . '-' . $pid;
		$data ['year'] = date ( 'Y', $data ['time'] );
		$data ['month'] = date ( 'm', $data ['time'] );
		$data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
		$document = M ( 'Document' );
		$res = $document->add ( $data );
		
		if ($res) {
			// 标签管理添加
			$key = A ( 'Keyword' );
			$key->automake ( $res, $_REQUEST ["form_tag"], 'document' );
			$this->formSuccess ( "新增资料", "/document/create.html" );
		} else {
			$this->formError ( "新增资料", "/document/create.html" );
		}
	}
	
	// 更新文档资料
	public function update() {
		$this->formLoginCheck ();
		
		$article = M ( 'Document' );
		// 组织数据
		// 表单处理
		$length = 0;
		$length = getLength ( $_POST ['form_title'] );
		if ($length > 100) {
			$this->formErrorReferer ( "标题长度不能超过100个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "标题不能为空" );
		}
		$length = getLength ( $_POST ['form_author'] );
		if ($length > 100) {
			$this->formErrorReferer ( "作者长度不能超过100个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "作者不能为空" );
		}
		$length = getLength ( $_POST ['url'] );
		if ($length > 200) {
			$this->formErrorReferer ( "网盘地址长度不能超过200个字" );
		}
		if ($length < 1) {
			$this->formErrorReferer ( "网盘地址不能为空" );
		}
		$data ["uid"] = $_SESSION ["Auth"] ["id"];
		
		$id = $_REQUEST ["article_id"];
		$res1 = $article->where ( array (
				"id" => $id 
		) )->field ( "uid" )->find ();
		if (! $res1 || $res1 ["uid"] != $data ["uid"]) {
			$this->formError ( "非法操作", "/index/index.html" );
		}
		
		$data ["id"] = $id;
		$data ["title"] = htmlspecialchars ( $_POST ["form_title"] );
		$data ["content"] = htmlspecialchars ( $_POST ["content"] );
		
		$length = getLength ( $data ["content"] );
		if ($length < 1) {
			$this->formErrorReferer ( "内容不能为空" );
		}
		if ($length > 10000) {
			$this->formErrorReferer ( "内容长度不能超过10000" );
		}
		
		$data ["author"] = htmlspecialchars ( $_POST ["form_author"] );
		$data ["urltype"] = ( int ) $_POST ["urltype"];
		$data ["doctype"] = ( int ) $_POST ["doctype"];
		$data ["url"] = htmlspecialchars ( $_POST ["url"] );
		
		// 是否传了图片
		$imgurl = "";
		if (! empty ( $_FILES )) {
			// 图片上传处理
			import ( 'ORG.Net.UploadFile' );
			$upload = new UploadFile (); // 实例化上传类
			$upload->maxSize = 1024 * 1024 * 10; // 设置附件上传大小
			$upload->allowExts = array (
					'jpg',
					'png',
					'jpeg' 
			); // 设置附件上传类型
			$upload->thumb = true;
			$upload->thumbMaxWidth = '50,280';
			$upload->thumbMaxHeight = '50,280';
			// 取得当前用户的id 获取资料封面图片上传目录
			$dir = './Public/Uploads/document/' . md5 ( $_SESSION ['Auth'] ['id'] ) . '/';
			if (! is_dir ( $dir )) {
				@mkdir ( $dir );
			}
			$upload->savePath = $dir; // 设置附件上传目录
			
			if (! $upload->upload ()) { // 上传错误提示错误信息
				$imgurl = "";
			} else { // 上传成功 获取上传文件信息
				$info = $upload->getUploadFileInfo ();
				$imgurl = 'http://' . $_SERVER ['SERVER_NAME'] . '/Public/Uploads/document/' . md5 ( $_SESSION ['Auth'] ['id'] ) . '/thumb_' . $info [0] ['savename'];
				// 原图删除 留下280X280
				@unlink ( $dir . $info [0] ['savename'] );
			}
		} else {
			$imgurl = "";
			echo "failed";
		}
		
		if ($imgurl != "") {
			! @unlink ( $res1 ["imgurl"] );
			$data ["imgurl"] = $imgurl;
		}
		
		$pid = $_REQUEST ["form_category"];
		$category = M ( 'Category' );
		$info = $category->where ( 'id=' . $pid )->field ( 'path' )->find ();
		$data ['bpath'] = $info ['path'] . '-' . $pid;
		
		$res = $article->data ( $data )->save ();
		
		if ($res) {
			// 标签管理添加
			$key = A ( 'Keyword' );
			$key->updateCategory ( "document", $id, $_REQUEST ["form_tag"] );
			$this->formSuccess ( "修改资料", "/document/mylist.html" );
		} else {
			$this->formError ( "修改资料", "/document/mylist.html" );
		}
	}
	
	// 修改资料
	public function edit() {
		$this->formLoginCheck ();
		$article = M ( "Document" );
		$res = $article->where ( array (
				"id" => I( "get.id",'integer' )
		) )->find ();
		
		if (! $res || $res ["uid"] != $_SESSION ["Auth"] ["id"]) {
			$this->formError ( "资料不存在", "/index/index.html" );
		}
		// category id
		$category = explode ( '-', $res ["bpath"] );
		$category = $category [1];
		// dump($category);
		$this->assign ( "categoryid", $category );
		// 标签
		$key = A ( 'Keyword' );
		$this->assign ( "keyword", $key->getCategoryString ( "document", $res ["id"] ) );
		$res ["content"] = htmlspecialchars_decode ( $res ["content"] );
		$this->assign ( "article", $res );
		$this->display ();
	}
	
	// 删除文档资料
	public function del() {
		$this->formLoginCheck ();
		
		$id = ( int ) I ( "get.id" );
		$article = M ( 'Document' );
		$res = $article->where ( "id={$id} and uid={$_SESSION["Auth"]["id"]}" )->field ( "id" )->find ();
		
		if ($res) {
			$data ["isdel"] = 1;
			$data ["id"] = $id;
			$article->data ( $data )->save ();
			$this->formSuccess ( "删除成功", "/document/mylist.html" );
		} else {
			$this->formError ( "没有此文章", "/index/index.html" );
		}
	}
	
	// 查找文档资料
	//
	//
	public function search() {
		$category = ( int ) $_GET ["category"]; // id
		$tag = ( int ) $_GET ["tag"];
		
		if ($category > 0) {
			$CT = M ( "Category" );
			$res = $CT->where ( array (
					"id" => $category 
			) )->field ( "path" )->find ();
			
			$path = $res ["path"] . "-" . $category;
			
			$article = M ( "Document" );
			$count = $article->where ( "isdel = 0 and bpath like '" . $path . "%' " )->count ();
			if ($count > 0) {
				import ( "ORG.Util.Page" ); // 导入分页类
				$page = new Page ( $count, 8 );
				$page->setConfig ( 'header', '篇资料' );
				$page->setConfig ( 'prev', 'Prev Page' );
				$page->setConfig ( 'next', 'Next Page' );
				$show = $page->show ();
				
				$res = $article->query ( "select a.id,a.title,a.author,a.imgurl,a.url,a.bpath,a.urltype,a.doctype,a.content,a.time,a.month,a.year,u.name from vip_document as a,vip_user as u where a.uid = u.id and a.isdel = 0 and  a.bpath like '" . $path . "%' order by a.time desc limit {$page->firstRow},{$page->listRows}" );
				
				if (! $res) {
					$this->formErrorReferer ( "没有搜索到资料" );
				}
				
				$this->assign ( "article_list", $res );
				$this->assign ( "article_page", $show );
				$this->assign ( "count", $count );
				$this->display ();
			} else {
				$this->formErrorReferer ( "没有搜索到资料" );
			}
		} elseif ($tag > 0) {
			$CT = M ( "Documentkeyword" );
			$res = $CT->where ( array (
					"kid" => $tag 
			) )->field ( "realid" )->select ();
			
			$cnt = count ( $res );
			$where = "";
			if ($cnt < 1) {
				$this->formErrorReferer ( "没有搜索到资料" );
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
			
			$article = M ( "Document" );
			$result = $article->where ( "isdel = 0 and " . $where )->select ();
			
			if (! $res) {
				$this->formErrorReferer ( "没有搜索到资料" );
			}
			$this->assign ( "article_list", $result );
			
			$this->assign ( "count", count ( $result ) );
			$this->display ();
		} else {
			$this->formErrorReferer ( "没有搜索到资料" );
		}
	}
	
	/*
	 * public function mycollect() { $this->formLoginCheck(); $this->display();
	 * }
	 */
	public function mylist() {
		$this->formLoginCheck ();
		
		$article = M ( "Document" );
		
		$all = $article->where ( "isdel=0" )->count ();
		import ( "ORG.Util.Page" ); // 导入分页类
		$page = new Page ( $all, 8 );
		$page->setConfig ( 'header', '篇资料' );
		$page->setConfig ( 'prev', 'Prev Page' );
		$page->setConfig ( 'next', 'Next Page' );
		$show = $page->show ();
		
		$res = $article->query ( "select a.id,a.title,a.author,a.imgurl,a.url,a.bpath,a.urltype,a.doctype,a.content,a.time,a.month,a.year,u.name from vip_document as a,vip_user as u where a.isdel = 0 and u.id ={$_SESSION["Auth"]["id"]} and a.uid = u.id order by a.id desc limit {$page->firstRow},{$page->listRows}" );
		
		$this->assign ( "article_list", $res );
		$this->assign ( "article_page", $show );
		
		$this->display ();
	}
	
	
	//访问量增加
	public function addvisit()
	{
		$id = $this->_post("id");
		$doc = M ( "Document" );
		$res = $doc->where(array("id"=>$id))->field("id,visit")->find();
		if($res){
			$data["id"] = $id;
			$data["visit"] = $res["visit"] + 1;
			$doc->data($data)->save();
			echo "success";
		}else
		{
			echo "error";
		}
	}
}

