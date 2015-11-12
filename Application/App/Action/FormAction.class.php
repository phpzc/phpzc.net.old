<?php
namespace App\Action;
class FormAction extends CommonAction {
	
	// 处理表单结果显示 页面 成功或者失败
	public function index() {
	}
	public function success() {
		// 标题
		$title = $this->_get ( "title" );
		// 跳转页面
		$url = $this->_get ( "url" );
		$sec = $this->_get ( "sec" );
		$this->assign ( "title", $title );
		$this->assign ( "url", $url );
		$this->assign ( "sec", $sec );
		$this->display ();
	}
	public function error() {
		// 标题
		$title = $this->_get ( "title" );
		// 跳转页面
		$url = $this->_get ( "url" );
		$sec = $this->_get ( "sec" );
		$this->assign ( "title", $title );
		$this->assign ( "url", $url );
		$this->assign ( "sec", $sec );
		$this->display ();
	}
}
?>
