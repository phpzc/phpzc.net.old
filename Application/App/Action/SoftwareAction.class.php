<?php
namespace App\Action;
class SoftwareAction extends CommonAction {
	/*
	 * @brief 设置每一页标题
	 */
	public function _initialize() {
		parent::_initialize ();
		$action_name = strtolower ( ACTION_NAME );
		switch ($action_name) {
			case 'index' :
				$this->assign ( "website_title", "软件首页" );
				break;
			case 'create' :
				$this->assign ( "website_title", "发布软件" );
				break;
			case 'update' :
				$this->assign ( "website_title", "修改软件" );
				break;
		}
	}
	// 遍历列表 前20个软件
	public function index() {
		$this->display ();
	}
	
	// 创建软件
	public function create() {
	}
	// 更新软件
	public function update() {
	}
	
	// 删除软件
	public function del() {
	}
	
	// 查找软件
	//
	//
	public function search() {
	}
}

