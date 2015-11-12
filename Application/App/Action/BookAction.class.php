<?php
namespace App\Action;
class BookAction extends CommonAction {
	/*
	 * @brief 设置每一页标题
	 */
	public function _initialize() {
		parent::_initialize ();
		$action_name = strtolower ( ACTION_NAME );
		switch ($action_name) {
			case 'index' :
				$this->assign ( "website_title", "读书首页" );
				break;
			case 'create' :
				$this->assign ( "website_title", "创建读书感" );
				break;
			case 'update' :
				$this->assign ( "website_title", "修改读书感" );
				break;
		}
	}
	
	// 遍历列表 前20个读书
	public function index() {
		$this->display ();
	}
	
	// 创建读书
	public function create() {
	}
	// 更新读书
	public function update() {
	}
	
	// 删除读书
	public function del() {
	}
	
	// 查找读书
	//
	//
	public function search() {
	}
}

