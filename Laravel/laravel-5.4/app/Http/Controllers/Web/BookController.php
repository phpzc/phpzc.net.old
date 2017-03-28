<?php
namespace App\Http\Controllers\Web;

use App\Model\BookCookie;

class BookController extends CommonController
{

    public function _initialize() {
        parent::_initialize ();
        $action_name = strtolower ( getCurrentMethod() );
        switch ($action_name) {
            case 'index' :
                $this->assign ( 'website_title', '读书首页' );
                break;
            case 'create' :
                $this->assign ( 'website_title', '创建读书感' );
                break;
            case 'update' :
                $this->assign ( 'website_title', '修改读书感' );
                break;
            case 'search' :
                $this->assign ( 'website_title', 'FreeStory[小说免费阅读]' );
                break;
        }
    }


    public final function index()
    {
        return view('book.index');
    }

    public final function search() {

        $searchword = request()->input('word');

        $clear = request()->input('clear');
        //var_dump($searchword);
        $menuData = [];

        if($clear == 1)
        {
            request()->session()->regenerate(true);
        }


        if(!request()->session()->has('book_'.$searchword)) {


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

            session(['book_' . $searchword=> $totalArray]);
        }

        show:
        //
        if( request()->session()->has('book_' . $searchword))
        {

            $free = new \FreeStory\FreeStory();

            if(request()->session()->has('book_detail_'.$searchword))
            {

            }else{
                $desc = $free->search($searchword);
                if(!empty($desc)){
                    session(['book_detail_'.$searchword=>get_object_vars($desc)]);
                }
            }


            $this->assign('StoryDetail',(object) session('book_detail_'.$searchword) );

            $this->assign('StoryDetail2',json_encode(['book_detail'=>session('book_detail_'.$searchword)]) );


        }


        $this->assign('book',session('book_'.$searchword));
        $bookcookie = $this->getBook();

        $this->assign('book_cookie',$bookcookie );


        return view('book.search');
    }

    /**
     * 笔趣阁小说内容获取
     */
    public final function getContent()
    {
        $bid = request()->input('bid');//书的id
        $ourl = request()->input('url');//章节的id
        $word = urldecode(request()->input('word'));

        $url = 'http://www.qu.la/book/'.$bid.'/'.$ourl.'.html';

        $data = $this->request($url);

        $preg = '/<div id="content"><script>readx\(\);<\/script>(.*?)<\/div>/s';
        preg_match($preg,$data,$match);

        $content = iconv("GB2312//IGNORE","UTF-8//IGNORE",$match[1]) ;

        $menu = $this->getOtherChap($bid,$word,$ourl);
        echo '<title>'.urldecode(request()->input('title','')).'</title>';
        echo $menu.'<br/>';
        echo "<style>div{font-size:3em;}</style><div><a href='/book/search'>Search</a><br/>";

        echo $content;
        echo "</div>";

        echo $menu;
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
        $tmp = ['url'=>'','title'=>''];
        foreach ($data['menu'] as $k=>$v)
        {
            if($v['url'] == $this_url)
            {
                $title = $v['title'];
                $prevData = $data['menu'][$k+1]??$tmp;
                $nextData = $data['menu'][$k-1]??$tmp;

                $prev = $prevData['url'];
                $next = $nextData['url'];

                $prev_title = $prevData['title'];
                $next_title = $nextData['title'];
                break;
            }
        }


        return '<p style="font-size: 3em"><a href="/book/search?word='.urlencode($word).'">首页</a> | <a href="/book/getContent?bid='.$bid.'&url='.$prev.'&word='.urlencode($word).'&title='.urlencode($prev_title).'">'.$prev_title.'</a> |'.$title.'| <a href="/book/getContent?bid='.$bid.'&url='.$next.'&word='.urlencode($word).'&title='.urlencode($next_title).'">'.$next_title.'</a></p>';
    }


    //加入书架
    public final function addBook()
    {
        //小说的信息
        //detail
        //

        if(request()->session()->has('id'))
        {

            $data = request()->input('book_detail');

            $find = BookCookie::where(['uid'=>session('id'),'book_name'=>$data['title']])->first();

            if(!$find){

                BookCookie::insert([
                    'uid'=>session('id'),
                    'book_name'=>$data['title'],
                    'value'=>json_encode($data,true),
                ]);
                session(['book_cookies_'.session('id')=>null]);
            }

        }

    }

    //删除书架
    public final function delBook()
    {
        if(request()->session()->has('id'))
        {

            $title = request()->input('book_title');

            $find = BookCookie::where(['uid'=>session('id'),'book_name'=>$title])->first();
            if($find) {

                BookCookie::where(['id'=>$find->id])
                    ->delete();
                session(['book_cookies_'.session('id')=>null]);
            }
        }
    }

    //取得书架信息
    public final function getBook()
    {
        if(request()->session()->has('id'))
        {
            if(session('book_cookies_'.session('id'))){
                return session('book_cookies_'.session('id'));
            }else{
                $model = M('book_cookie');
                $find = $model->where(['uid'=>$_SESSION ['Auth']['id']])->select();

                $find = BookCookie::where(['uid'=>session('id')])->get();

                $find = $find->toArray();

                foreach ($find as $k=>$v)
                {
                    $find[$k]['value'] = json_decode($v['value'],true);
                }
                session('book_cookies_'.session('id'),$find);
                return session('book_cookies_'.session('id'));
            }

        }else{
            return [];
        }
    }

}