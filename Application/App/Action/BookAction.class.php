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
	//  获取目录
	//
	public function search() {

		$searchword = I('request.word');
		$menuData = [];

		if(!session('book_'.$searchword)) {


			$url = 'http://so.biquge.la/cse/search?s=7138806708853866527&q=' . $searchword;
			$data = $this->request($url);
			if (empty($data)) {
				goto show;
			}
			//搜索记录是否存在
			$preg = "/<a cpos=\"title\" href=\"http:\/\/www.biquge.la\/book\/(\d+)\/\" title=\"{$searchword}\" class=\"result-game-item-title-link\" target=\"_blank\">/s";

			$matchResult = preg_match($preg, $data, $match);

			if (empty($matchResult)) {
				goto show;
			}

			//提取目录id 获得目录页数据
			$id = $match[1];
			$url = 'http://www.biquge.la/book/' . $id . '/';
			$data = $this->request($url);

			if (empty($data)) {
				goto show;
			}

			$preg = '/<dl>(.*?)<\/dl>/s';
			$matchResult = preg_match($preg, $data, $match);
			if (empty($matchResult)) {
				goto show;
			}
			$mulu = iconv("GB2312//IGNORE", "UTF-8", $match[1]);
			//提取具体章节数据
			//匹配出 章节对应页面
			$preg = '/<a href="(.*?)">(.*?)<\/a>/s';
			$matchResult = preg_match_all($preg, $mulu, $match);

			if (empty($matchResult)) {
				goto show;
			}

			//取得目录 数据
			$menu = $this->getMenu($match);

			//最终返回数据
			$totalArray = [
				'id' => $id,
				'menu' => $menu,
			];

			session('book_' . $searchword, $totalArray);
		}
		
show:		
		$this->assign('book',session('book_'.$searchword));
		$this->display();
		
	}


	/**
	 * 笔趣阁小说内容获取
	 */
	public function getContent()
	{
		$bid =  I('request.bid');//书的id
		$ourl = I('request.url');//章节的id

		$url = 'http://www.biquge.la/book/'.$bid.'/'.$ourl.'.html';

		$data = $this->request($url);

		$preg = '/<div id="content"><script>readx\(\);<\/script>(.*?)<\/div>/s';
		preg_match($preg,$data,$match);

		$content = iconv("GB2312//IGNORE","UTF-8",$match[1]) ;
		echo $content;

	}




	protected function request($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($curl);
		curl_close($curl);

		return $data;
	}



	protected function getMenu($match)
	{
		$menu = [];
		foreach ($match[2] as $k=>$v)
		{
			$menu[] = [
				'title'=>$v,
				'url'=>rtrim($match[1][$k],'.html'),
			];
		}
		$menu = array_reverse($menu);

		return $menu;
	}
}

