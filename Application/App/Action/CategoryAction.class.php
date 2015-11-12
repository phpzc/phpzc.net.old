<?php
class CategoryAction extends CommonAction {
	/**
	 * 只有我能访问这个页面
	 *
	 * @see CommonAction::_initialize()
	 */
	public function _initialize() {
		parent::_initialize ();
		
		if ($_SESSION ["Auth"] ["id"] != 1) {
			$this->_empty ();
		}
	}
	public function index() {
		$c = M ( 'Category' );
		$r = $c->query ( "select *,concat(path,'-',id) as bpath from vip_category order by bpath,id desc" );
		
		$this->assign ( 'result', $r );
		// dump($r);
		$this->display ();
	}
	public function add() {
		$c = M ( 'Category' );
		$data = array ();
		$res = '';
		foreach ( $_POST as $k => $v ) {
			
			if ($k == 'top') {
				foreach ( $v as $x ) {
					if (empty ( $x ))
						continue;
					$data ['name'] = $x;
					$data ['pid'] = 0;
					$data ['path'] = 0;
					// dump($data);
					$res = $c->add ( $data );
				}
			} else {
				$id = explode ( 'd', $k );
				$id = $id [1];
				$path = $c->where ( 'id=' . $id )->find ();
				$path = $path ['path'];
				$path = $path . '-' . $id;
				foreach ( $v as $x ) {
					if (empty ( $x ))
						continue;
					$data ['name'] = $x;
					$data ['pid'] = $id;
					$data ['path'] = $path;
					// dump($data);
					$res = $c->add ( $data );
				}
			}
		}
		unset ( $_SESSION ['select_category'] );
		$this->success ( '添加成功' );
	}
	public function edit() {
		$name = $_GET ['data'];
		$id = $_GET ['id'];
		$c = M ( 'Category' );
		$update = $c->where ( 'id=' . $id )->save ( array (
				'name' => $name 
		) );
		if ($update) {
			unset ( $_SESSION ['select_category'] );
			$this->success ( '修改成功' );
		} else {
			$this->error ( '修改失败' );
		}
	}
	public function del() {
		$id = $this->_get ( 'id' );
		$c = M ( 'Category' );
		try {
			$r = $c->where ( 'id=' . $id )->find ();
			$d = $c->where ( "path like '" . $r ['path'] . "-" . $id . "%'" )->delete ();
			// 删除旗下所有的类
			$x = $c->where ( 'id=' . $id )->delete ();
			unset ( $_SESSION ['select_category'] );
			$this->success ( '删除成功' );
		} catch ( Exception $e ) {
			echo $e->getMessage ();
		}
	}
}