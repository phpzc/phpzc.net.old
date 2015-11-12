<?php
namespace App\Action;
class PhotoAction extends CommonAction {
	
	//删除图片
	public function del(){
		$this->jsonLoginCheck();
		
		$id =$_REQUEST["id"];
		
		// 删除数据
		$photo = M("Photo");
		$data["id"] = $id;
		$data["isdel"] = 1;
		$res = $photo->data($data)->save();
		if($res){
			$album = M("Album");
			$r = $album->where(array("id"=>$_POST['aid']))->field("num")->find();
			$tdata["id"] = $r["id"];
			$tdata["num"] = $r["num"]-1;
			$album->data($tdata)->save();
			jsonP(array(),0);
		}
		else
			jsonP("数据操作失败".$id,1);
		// 删除文件
		
	}
	//添加图片
	public function dealCreate(){
		$this->formLoginCheck();
		
		//验证相册有效性
		$album = M("Album");
		$result = $album->where(array("id"=>$_REQUEST["myalbum_id"],"uid"=>$this->getId()))->field("id,num")->find();
		if(!$result){
			//jsonP("相册不存在", 1);
			$this->formErrorReferer("相册不存在");
		}

		//文件上传
		
		//添加文件 
		foreach ($_FILES["photo"]["error"] as $v){
			if($v != 0){
				//jsonP("文件上传发生错误,请重新上传", 1);
				$this->formErrorReferer("文件上传发生错误,请重新上传");
			}
				
		}
		//添加数据
		$filename = $this->addFile();
		//dump($filename);
		
		//处理数据到数据库
		$photo = M("Photo");
		
		$len = count($filename);
		
		$data ["time"] = time ();
		$data ["uid"] = $_REQUEST["myalbum_id"];
		$data ['year'] = date ( 'Y', $data ['time'] );
		$data ['month'] = date ( 'm', $data ['time'] );
		$data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );
		foreach ($filename as $v)
		{
			$data["imgurl"] = $v["imgurl"];
			$res = $photo->add($data);
			
		} 
		//更新相册数量
		$tdata = array(
			"id"=>$_REQUEST["myalbum_id"],
			"num"=>$result["num"]+$len
		);
		$album->data($tdata)->save();
		
		$this->formSuccess("上传成功", "/album/mylist.html");

	}
	
	//旧的老的写入文件图片
	public function index() {
		$photo = D ( 'photo' );
		$limit = 10;
		$maxId = 17420;
		$id = $_GET ["id"] ? $_GET ["id"] : 1;
		if ($id > $maxId) {
			exit ( "over" );
		}
		$data = $photo->where ( "id = " . $id )->find ();
		
		$arra = explode ( '/', $data ["url"] );
		$dir1 = $arra [4];
		$dir2 = $arra [3];
		$base = "image";
		$thisDir = $base . '/' . $dir1 . '_' . $dir2;
		
		if (! is_dir ( $thisDir )) {
			mkdir ( $thisDir, 0777 );
		}
		
		// echo $data['url'].'<br />';
		$img = file_get_contents ( $data ['url'] );
		
		// sleep(2);
		$s1 = explode ( '.', $data ['url'] );
		$s1 = array_pop ( $s1 );
		$s2 = explode ( '!', $s1 );
		$type = $s2 [0];
		// dump($s1);
		// dump($s2);
		// echo $type;
		
		if ($type == 'jpg' || $type == 'jpeg') {
			$type = 'jpg';
		}
		
		// echo "jpg";
		$x = file_put_contents ( $thisDir . '/' . $id . '.' . $type, $img );
		
		echo $id . "----success";
		
		echo "<script>location.href ='http://www.test.com/photo/index/id/" . ($id + 1) . "';</script>";
	}
	
	/**
	 * 添加图片文件
	 * 	根据sae or local 来添加文件
	 * @return $filename 返回添加后的文件名
	 */
	private function addFile()
	{
		$filename = "";
		if(ENV_SAE)
		{
			$index = 0;
			$count = count($_FILES["photo"]["name"]);
			$filename = array();
			for(;$index<$count;$index++)
			{
				//$filename[$index] = $this->addFile($index);
			}	
		}else{
			$filename = $this->dealFile();	
		}
		
		return $filename;
	}
	/**
	 * 删除图片文件
	 * 	根据sae or local 来删除文件
	 *@param $filePath 图片文件路径 或者 Sae Storage
	 *@return boolean
	 */
	private function delFile($filePath)
	{
		
		if(ENV_SAE)
		{
			$stor = new SaeStorage();
			$stor->delete( $domain, $filename );
		}else{
			
		}
		
		return true;
	}
	
	/**
	 * 处理图片 全部的图片 包括 单和多文件上传
	 * 	存储位置
	 *
	 *@return array 
	 */
	private function dealFile()
	{
		// 图片上传处理
		import ( 'ORG.Net.UploadFile' );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = 1024 * 1024 * 10; // 设置附件上传大小
		$upload->allowExts = array (
				'jpg',
				'png',
				'jpeg'
		); // 设置附件上传类型
		
		// 取得当前用户的id 获取资料封面图片上传目录
		$dir = './Public/Uploads/photo/' . md5 ( $_SESSION ['Auth'] ['id'] ) . '/';
		if (! is_dir ( $dir )) {
			@mkdir ( $dir );
		}
		
		if(!is_writable($dir))
		{
			chmod($dir,0777);
		}
		
		
		$upload->savePath = $dir; // 设置附件上传目录
		$info = "";
		if (! $upload->upload ()) { // 上传错误提示错误信息
			// $this->error($upload->getErrorMsg());
			 dump($upload->getErrorMsg());
			//jsonP("文件上传不成功", 1);
			
			 exit();
			//$this->formErrorReferer("文件上传不成功");
		} else { // 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo ();
			//dump ( $info );
			foreach ($info as $k=>$v)
			{
				$info[$k]["imgurl"] ='http://'.$_SERVER ['SERVER_NAME']."/Public/Uploads/photo/". md5 ( $_SESSION ['Auth'] ['id'] ) . "/".$v["savename"];
			}
		}
		return $info;
	}
	
	
}
