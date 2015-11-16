<?php
namespace App\Action;
use Think\Action;
class EmptyAction extends Action {
	public function _initialize() {
		// 分配网站名称
		$_WEBSITE ["url"] = "http://www.vipmhxy.com";
		$_WEBSITE ["url_short"] = "www.vipmhxy.com";
		$_WEBSITE ["name"] = "随心网";
		$this->assign ( "WEBSITE", $_WEBSITE );
	}
	public function _empty() {
		header ( "HTTP/1.0 404 Not Found" );
		$this->display ( 'Public:error-404' );
		exit ();
	}
	
	// 404
	public function index() {
		header ( "HTTP/1.0 404 Not Found" );
		$this->display ( 'Public:error-404' );
	}
}
