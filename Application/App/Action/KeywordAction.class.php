<?php
class KeywordAction extends CommonAction {
	public function index() {
	}
	public function add() {
	}
	public function del() {
	}
	public function edit() {
	}
	
	/*
	 * 处理标签方法 @param $insertId 插入id @param $data tag数据 @param $tableName
	 * 要对哪个表做关键字
	 */
	public function automake($insertId, $data, $tableName) {
		$resource = M ( $tableName . "keyword" );
		$arr ['realid'] = $insertId;
		$keywordTable = M ( 'Keyword' );
		$x = null;
		$add = null;
		
		if (! empty ( $data )) {
			$data = str_replace ( '，', ",", $data );
			$dataArr = explode ( ',', trim ( $data, ',' ) );
			dump ( $dataArr );
			$i = 0;
			foreach ( $dataArr as $v ) {
				// 取得标签id
				if ($x = $keywordTable->where ( array (
						'name' => $v 
				) )->find ()) {
					
					$arr ['kid'] = $x ['id'];
				} else {
					$add = $keywordTable->data ( array (
							'name' => $v 
					) )->add ();
					$arr ['kid'] = $add;
				}
				// dump($arr);
				// 插入相对应的 标签表中
				$resource->data ( $arr )->add ();
				
				$i ++;
				if ($i == 5)
					break;
			}
		}
	}
	
	/*
	 * 取得当前文章的关键字 @param $tableName @param $realid @return $str
	 */
	public function getCategoryString($tableName, $realid) {
		$name = strtolower ( $tableName ) . 'keyword';
		$name2 = "vip_" . $name;
		$table = M ( $name );
		// 找出keyword id
		$kres = $table->where ( array (
				"realid" => $realid 
		) )->select ();
		if (count ( $kres ) == 0) {
			return "";
		} elseif (count ( $kres ) == 1) {
			$where = 'id = ' . $kres [0] ['kid'];
		} else {
			$where = 'id in (';
			foreach ( $kres as $v ) {
				$where .= $v ['kid'] . ',';
			}
			$where = trim ( $where, ',' ) . ')';
		}
		$KEYWORD = M ( 'Keyword' );
		$res = $KEYWORD->where ( $where )->field ( 'name' )->select ();
		
		if ($res) {
			$str = "";
			foreach ( $res as $v ) {
				$str .= $v ["name"] . ',';
			}
			
			return trim ( $str, ',' );
		}
		return "";
	}
	
	/*
	 * 更新标签 @param $tableName @param $realid @param $str	关键字字符串 @return
	 */
	public function updateCategory($tableName, $realid, $tagstr) {
		// 先删除旧的 再添加新的
		$name = ucfirst ( strtolower ( $tableName ) ) . 'keyword';
		$table = M ( $name );
		$table->where ( array (
				"realid" => $realid 
		) )->delete ();
		
		$this->automake ( $realid, $tagstr, $tableName );
	}
}