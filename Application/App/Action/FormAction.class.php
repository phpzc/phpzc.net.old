<?php
namespace App\Action;
class FormAction extends CommonAction {
	
	// 处理表单结果显示 页面 成功或者失败
	public function index() {
	}
	public function success() {
		
		// 标题
		$title = I( "get.title" );
		// 跳转页面
		$url = I( "get.url" );
		$sec = I( "get.sec" );
		$this->assign ( "title", $title );
		$this->assign ( "url", base_decode($url) );
		$this->assign ( "sec", $sec );
		$this->display ();
	}
	public function error() {
		// 标题
		$title = I( "get.title" );
		// 跳转页面
		$url = I( "get.url" );
		$sec = I( "get.sec" );
		$this->assign ( "title", $title );
		$this->assign ( "url", base_decode($url) );
		$this->assign ( "sec", $sec );
		$this->display ();
	}
}
?>
