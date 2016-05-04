<?php
namespace App\Action;
/**
 * 
 * 相册 分类 具体的图片 在Photo 里面
 * @author PeakPointer
 *
 */
class AlbumAction extends CommonAction {
	public function _initialize() {
		parent::_initialize ();
		$action_name = strtolower ( ACTION_NAME );
		switch ($action_name) {
			case 'index' :
				$this->assign ( "website_title", "相册 -" );
				break;
			case 'mylist' :
				$this->assign ( "website_title", "相册列表 -" );
				break;
		}
	}
	

	public function index()
	{
		$album = M ( 'Album' );
		$res = $album->field ( 'id,title,num,face' )->where ( array (
				"isdel" => 0,"auth"=>0
		) )->order ( "id desc" )->limit(100)->select ();

		foreach ( $res as $k => $v ) {
			$res[$k]["title"] = strip_tags ( htmlspecialchars_decode ( $v ['title'] ) );
			$res[$k]["id"] = $this->encodeId ( $v ['id'] );
			$res[$k]["realid"] = $v["id"];
		}

		$this->assign ( "album_list", $res );
		$this->display();
	}
	
	public function mylist()
	{
		$this->formLoginCheck();
		$album = M ( 'Album' );
		$res = $album->field ( 'id,title,num,content,auth,face' )->where ( array (
				"isdel" => 0,"uid"=>$_SESSION["Auth"]["id"]
		) )->order ( "id desc" )->limit(100)->select ();
	
		foreach ( $res as $k => $v ) {
			$res[$k]["title"] = strip_tags ( htmlspecialchars_decode ( $v ['title'] ) );
			$res[$k]["id"] = $this->encodeId ( $v ['id'] );
			$res[$k]["realid"] = $v["id"];
		}
	
		$this->assign ( "album_list", $res );
		$a = json_encode($res,true);
		$this->assign("album_json",$a);

		$this->display();
	}
	
	//查询相册信息 及相关照片信息 返回json  
	public function detail() {
		$id = I("get.id",'integer' );
		if (empty ( $id )) {
			$this->_empty ();
		}
		
		//$id = $this->decodeId ( $id );
		// 搜索文章
		$article = M ( "Photo" );
		
		$res = $article->where(array(
			"uid"=>$id,"isdel"=>0
		))->select();
		$album = M("Album");
		$res2 = $album->where(array("id"=>$id))->find();
		$this->assign("album",$res2);
		if($res2["uid"] == $this->getId())
		{
			$this->assign("my",1);
		}
		if ($res) {
			
			$this->assign ( 'photo', $res );
			
		}
		$this->display ();
	}
	
	
	//处理添加相册  标题 描述 
	public function dealCreate() {
		$data ["title"] = htmlspecialchars ( $_REQUEST ["title"] );
		if ($this->jsonLengthCheck( $data ["title"], 30 )){
			jsonP("相册名称长度不正确",1);
		}
		$data ["content"] = htmlspecialchars ( $_REQUEST ["content"] );
		if ($this->jsonLengthCheck( $data ["content"], 200 )){
			jsonP("相册描述长度不正确",1);
		}
		$data ["auth"] = (int) ( $_REQUEST ["auth"] );
		
		$data ["time"] = time ();
		$data ["uid"] = $_SESSION ["Auth"] ["id"];
		
		$data ['year'] = date ( 'Y', $data ['time'] );
		$data ['month'] = date ( 'm', $data ['time'] );
		$data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
		$album = M ( 'Album' );
		$res = $album->add ( $data );
		
		if ($res) {
			jsonP(array(),0);
		} else {
			jsonP("数据库添加失败",1);
		}
	}
	
	public function dealUpdate(){
		$data ["title"] = htmlspecialchars ( $_REQUEST ["title"] );
		if ($this->jsonLengthCheck( $data ["title"], 30 )){
			jsonP("相册名称长度不正确",1);
		}
		$data ["content"] = htmlspecialchars ( $_REQUEST ["content"] );
		if ($this->jsonLengthCheck( $data ["content"], 200 )){
			jsonP("相册描述长度不正确",1);
		}
		$data ["auth"] = (int) ( $_REQUEST ["auth"] );
		$data ["id"] = $_REQUEST ["id"];
		$album = M ( 'Album' );
		$res = $album->data( $data )->save ();
		
		if ($res) {
			jsonP(array(),0);
		} else {
			jsonP("数据更新失败或者数据未变化",1);
		}
		
	}
	
	/**
	 * 设置相册封面
	 */
	public function setFace()
	{
		$this->jsonLoginCheck();
		
		$data["id"] = $_REQUEST ["id"];
		$data["face"] = $_REQUEST ["face"];
		$album = M ( 'Album' );
		//判断相册是否是用户创建的
		$r = $album->where(array("id"=>$data["id"]))->find();
		
		if($r["uid"] != $this->getId())
		{
			jsonP("数据错误",1);
		}
		
		$res = $album->data( $data )->save ();
		if ($res) {
			jsonP(array(),0);
		} else {
			jsonP("数据更新失败或者数据未变化",1);
		}
	}
	
	//删除相册
	public function del() {
		$this->formLoginCheck ();
		$id = ( int ) $this->_get ( "id" );
		$album = M ( 'Album' );
		$res = $album->where ( "id={$id} and uid={$_SESSION["Auth"]["id"]}" )->field ( "id" )->find ();
		
		if ($res) {
			$data ["isdel"] = 1;
			$data ["id"] = $id;
			$album->data ( $data )->save ();
			//jsonP(array(), 0);
			$this->formSuccess ( "删除成功", "/album/mylist.html" );
		} else {
			//jsonP("数据库操作失败",1);
			$this->formErrorReferer ( "删除失败" );
		}
	}

	public function gallerySsortimages()
	{

	}


	public function create_album()
	{
		if(IS_GET){
			$this->display();
		}else{
			$data ["title"] = htmlspecialchars ( $_REQUEST ["title"] );
			if ($this->jsonLengthCheck( $data ["title"], 30 )){
				$this->formErrorReferer("相册名称长度不正确");
			}
			$data ["content"] = htmlspecialchars ( $_REQUEST ["content"] );
			if ($this->jsonLengthCheck( $data ["content"], 200 )){
				$this->formErrorReferer("相册描述长度不正确",1);
			}
			$data ["auth"] = (int) ( $_REQUEST ["auth"] );

			$data ["time"] = time ();
			$data ["uid"] = $_SESSION ["Auth"] ["id"];

			$data ['year'] = date ( 'Y', $data ['time'] );
			$data ['month'] = date ( 'm', $data ['time'] );
			$data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
			$album = M ( 'Album' );
			$res = $album->add ( $data );

			if ($res) {
				$this->formSuccess('');
			} else {
				$this->formErrorReferer("数据库添加失败",1);
			}
		}

	}

	public function create_page()
	{
		$this->formLoginCheck();
		if(IS_GET){
			$album = M ( 'Album' );
			$res = $album->field ( 'id,title,num,content,auth,face' )->where ( array (
				"isdel" => 0,"uid"=>$_SESSION["Auth"]["id"]
			) )->select ();

			foreach ( $res as $k => $v ) {
				$res[$k]["title"] = strip_tags ( htmlspecialchars_decode ( $v ['title'] ) );
				$res[$k]["id"] = $v ['id'];
			}

			$this->assign ( "album_list", $res );

			$this->display();
		}else{
			$data = I('post.');
			$data['images'] = $data['mortgaged-img-url'];
			$model =  M('photo');

			$newdata=[];
			$time = time();
			$y=date ( 'Y', $time );
			$m=date ( 'm', $time );
			$ip =ip2long ( $_SERVER ["REMOTE_ADDR"] );
			foreach ($data['images'] as $k=>$v){
				$newdata[$k]['imgurl'] = NET_NAME.$v;
				$newdata[$k]['uid'] = $data['uid'];
				$newdata[$k]["time"] = $time;
				$newdata[$k]['year'] = $y;
				$newdata[$k]['month'] = $m;
				$newdata[$k]['ip'] = $ip;
			}
			$res = $model->addAll($newdata);
			if($res){
				$this->actionReturn(1,'上传成功','/album');
			}else{
				$this->actionReturn(0,'上传失败');
			}
		}

	}
}
