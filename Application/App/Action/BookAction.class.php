<?php
namespace App\Action;

include './vendor/autoload.php';

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
            case 'search' :
                $this->assign ( "website_title", "FreeStory[小说免费阅读]" );
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

		($searchword = I('request.word') )|| ($searchword = $_POST['word']);
		//var_dump($searchword);
		$menuData = [];
		
		if(I('request.clear') == 1)
		{
			//echo 'clear';
			session(null);
		}
		

		if(!session('book_'.$searchword)) {


			$url = 'http://zhannei.baidu.com/cse/search?s=920895234054625192&q=' . $searchword;
			$data = $this->request($url);
			if (empty($data)) {
				goto show;
			}
			$searchword = urldecode($searchword);
			//搜索记录是否存在
			$preg = "/<a cpos=\"title\" href=\"http:\/\/www.qu.la\/book\/(\d+)\/\" title=\"{$searchword}\" class=\"result-game-item-title-link\" target=\"_blank\">/s";

			$matchResult = preg_match($preg, $data, $match);

			if (empty($matchResult)) {
				goto show;
			}

			//提取目录id 获得目录页数据
			$id = $match[1];
			$url = 'http://www.qu.la/book/' . $id . '/';
			$data = $this->request($url);

			if (empty($data)) {
				goto show;
			}

			$preg = '/<dl>(.*?)<\/dl>/s';
			$matchResult = preg_match($preg, $data, $match);
			if (empty($matchResult)) {
				goto show;
			}
			$mulu = iconv("GB2312//IGNORE", "UTF-8//IGNORE", $match[1]);
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
        //
        if( session('?book_' . $searchword))
        {

            $free = new \FreeStory\FreeStory();

            if(session('?book_detail_'.$searchword))
            {

            }else{
                $desc = $free->search($searchword);
                if(!empty($desc)){
                    session('book_detail_'.$searchword,get_object_vars($desc));
                }
            }


            $this->assign('StoryDetail',(object) session('book_detail_'.$searchword) );

            $this->assign('StoryDetail2',json_encode(['book_detail'=>session('book_detail_'.$searchword)]) );


        }


		$this->assign('book',session('book_'.$searchword));
        $this->assign('book_cookie',$this->getBook());
		$this->display();

	}


	/**
	 * 笔趣阁小说内容获取
	 */
	public function getContent()
	{
		$bid =  I('request.bid');//书的id
		$ourl = I('request.url');//章节的id
		$word = urldecode(I('request.word'));
		$url = 'http://www.qu.la/book/'.$bid.'/'.$ourl.'.html';

		$data = $this->request($url);

		$preg = '/<div id="content"><script>readx\(\);<\/script>(.*?)<\/div>/s';
		preg_match($preg,$data,$match);

		$content = iconv("GB2312//IGNORE","UTF-8//IGNORE",$match[1]) ;

        $menu = $this->getOtherChap($bid,$word,$ourl);
        echo '<title>'.urldecode(I('request.title')).'</title>';
        echo $menu.'<br/>';
        echo "<style>div{font-size:3em;}</style><div><a href='/book/search'>Search</a><br/>";

		echo $content;
		echo "</div>";

		echo $menu;
	}

	/**
	 * 取得上一个 下一个
	 *
	 * @param $bid
	 * @param $word
	 * @param $this_url 当前章节url id
	 */
	protected function getOtherChap($bid,$word,$this_url)
	{
		$prev = '';
		$next = '';
		$title = '';
		$data = session('book_'.$word);
		$prev_title = 'prev';
		$next_title = 'next';
		foreach ($data['menu'] as $k=>$v)
		{
			if($v['url'] == $this_url)
			{
				$title = $v['title'];
				$prev = $data['menu'][$k+1]['url'];
				$next = $data['menu'][$k-1]['url'];
				$prev_title = $data['menu'][$k+1]['title'];
				$next_title = $data['menu'][$k-1]['title'];
				break;
			}
		}


		return '<p style="font-size: 3em"><a href="/book/search/word/'.urlencode($word).'">首页</a> | <a href="/book/getContent/bid/'.$bid.'/url/'.$prev.'/word/'.urlencode($word).'/title/'.urlencode($prev_title).'">'.$prev_title.'</a> |'.$title.'| <a href="/book/getContent/bid/'.$bid.'/url/'.$next.'/word/'.urlencode($word).'/title/'.urlencode($next_title).'">'.$next_title.'</a></p>';
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

	//加入书架
	public function addBook()
    {
        //小说的信息
        //detail
        //

        if($_SESSION ['Auth'] ['id'])
        {

            $data = I('request.book_detail');
            $model = M('book_cookie');
            $find = $model->where(['uid'=>$_SESSION ['Auth'] ['id'],'book_name'=>$data['title']])->find();
            if(!$find){
                M('book_cookie')->add([
                    'uid'=>$_SESSION ['Auth'] ['id'],
                    'book_name'=>$data['title'],
                    'value'=>json_encode($data,true),
                ]);

                session('book_cookies_'.$_SESSION ['Auth'] ['id'],null);
            }

        }

    }

    //删除书架
    public function delBook()
    {
        if($_SESSION ['Auth'] ['id'])
        {

            $title = I('request.book_title');
            $model = M('book_cookie');
            $find = $model->where(['uid'=>$_SESSION ['Auth'] ['id'],'book_name'=>$title])->find();
            if($find) {
                $model->where(['id'=>$find['id']])->delete();
                session('book_cookies_'.$_SESSION ['Auth'] ['id'],null);
            }
        }
    }

    //取得书架信息
    public function getBook()
    {
        if($_SESSION ['Auth'] ['id'])
        {
            if(session('?book_cookies_'.$_SESSION ['Auth'] ['id'])){
                return session('book_cookies_'.$_SESSION ['Auth'] ['id']);
            }else{
                $model = M('book_cookie');
                $find = $model->where(['uid'=>$_SESSION ['Auth']['id']])->select();
                foreach ($find as $k=>$v)
                {
                    $find[$k]['value'] = json_decode($v['value'],true);
                }
                session('book_cookies_'.$_SESSION ['Auth'] ['id'],$find);
                return session('book_cookies_'.$_SESSION ['Auth'] ['id']);
            }

        }else{
            return [];
        }
    }

}

