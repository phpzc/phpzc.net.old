<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/15
 * Time: 下午3:55
 */

namespace App\Http\Controllers\Web;

use App\Model\Article;
use App\Model\Category;

use Illuminate\Support\Facades\DB;

class ArticleController extends CommonController
{
    public function _initialize()
    {

        parent::_initialize();

        $action_name = strtolower(getCurrentMethod());
        switch ($action_name) {
            case 'index' :
                $this->assign('bread_crumbs', 'All Articles');
                break;
            case 'create' :
                $this->assign('bread_crumbs', 'Create Article');
                break;
            case 'search':
                $this->assign('website_title', '搜索文章结果');
                break;
        }
    }

    // 遍历列表 前20个文章
    public final function index()
    {

        $page = Article::where(['isdel' => 0, 'uid' => 1])
            ->orderBy('id', 'desc')
            ->join('user', 'article.uid', '=', 'user.id')
            ->select('article.*', 'user.name')
            ->paginate(8);
        $res1 = $page->toArray();
        if(empty($res1)){
            $res = [];
        }else{
            $res = $res1['data'];
        }





        foreach ($res as $k => $v) {
            $res [ $k ] ['content'] = strip_tags(htmlspecialchars_decode($v ['content']));
            $res [ $k ] ['id'] = $this->encodeId($v ['id']);

        }

        $this->assign('website_title', '文章');
        $this->assign('articles', $res);
        $this->assign('page', $page);



        return view('article.index');
    }


    // 创建文章
    public final function create() {
        // 登录检测
        $this->formLoginCheck ();

        $this->assign('website_title','添加文章');

        return view('article.create');
    }

    // 处理新增
    public final function dealCreate() {
        $this->formLoginCheck ();
        // 组织数据


        $data ['title'] = htmlspecialchars ( request()->input('form_title') );
        $data ['content'] = htmlspecialchars ( request()->input('form_article') );

        $this->fieldLengthCheck ( $data ['title'], '文章标题', 100 );

        $data ['time'] = time ();
        $data ['uid'] = session('id');
        $pid = request()->input('form_category');

        $info = Category::where(['id'=>$pid])->select('path')->first();
        if (! $info) {
            $this->formErrorReferer ( "非法操作" );
        }
        $info = $info->toArray();

        $data ['bpath'] = $info ['path'] . '-' . $pid;
        $data ['year'] = date ( 'Y', $data ['time'] );
        $data ['month'] = date ( 'm', $data ['time'] );
        $data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );


        $res = Article::insertGetId($data);

        if ($res) {
            $key = new KeywordController();
            $key->automake ( $res, $_REQUEST ["form_tag"], 'article' );
            $this->formSuccess ( "创建文章", "/article/create" );
        } else {
            $this->formErrorReferer ( "创建文章" );
        }
    }

    public final function create_markdown()
    {
        $this->formLoginCheck();
        $this->assign('website_title','添加文章');

        return view('article.create_markdown');

    }

    public final function dealCreateMarkdown()
    {

        $this->formLoginCheck ();

        $data['title'] = htmlspecialchars ( request()->input('form_title') );
        $data['content'] = request()->input('id-html-code');
        $data['markdown'] = request()->input('id-markdown-doc');
        $data['type'] = 1;

        $this->fieldLengthCheck ( $data['title'], "文章标题", 100 );

        $data ['time'] = time ();
        $data ['uid'] = session('id');
        $pid = request()->input('form_category');


        $info = Category::where(['id'=>$pid])->select('path')->first();
        if (! $info) {
            $this->formErrorReferer ( "非法操作" );
        }
        $info = $info->toArray();

        $data ['bpath'] = $info ['path'] . '-' . $pid;
        $data ['year'] = date ( 'Y', $data ['time'] );
        $data ['month'] = date ( 'm', $data ['time'] );
        $data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );


        $res = Article::insertGetId($data);

        if ($res) {
            $key = new KeywordController();
            $key->automake ( $res, $_REQUEST ["form_tag"], 'article' );
            $this->formSuccess ( "创建文章", "/article/create" );
        } else {
            $this->formErrorReferer ( "创建文章" );
        }
    }


    public final function edit() {
        $this->formLoginCheck ();


        $id = request()->input('id');

        $id = $this->decodeId ( $id );

        $res = Article::where(['id'=>$id])->first();


        if (! $res) {

            $this->formError ( "文章不存在", "/" );
        }

        $res = $res->toArray();


        // category id
        $category = explode ( '-', $res ['bpath'] );
        $category = $category [1];
        // dump($category);
        $this->assign ( 'categoryid', $category );
        // 标签
        $key = new KeywordController();
        $this->assign ( 'keyword', $key->getCategoryString ( 'article', $res ['id'] ) );


        $this->assign('website_title','修改文章');
        //根据文章类型 输出2种修改界面
        if($res['type'] == 1){

            $this->assign ( 'article', $res );


            return view('article.edit_markdown');
        }else{
            $res ['content'] = htmlspecialchars_decode ( $res ['content'] );
            $this->assign ( 'article', $res );

            return view('article.edit');
        }


    }


    /**
     * 更新文章 无法更新标签
     */
    public final function update() {

        $this->formLoginCheck ();

        // 组织数据
        $data ["uid"] = session('id');

        $id = $this->decodeId( request()->input('article_id'));



        $res1 = Article::where(['id'=>$id])->first();

        if (! $res1 ) {
            $this->formError ( "非法操作", '/' );
        }
        $res1 = $res1->toArray();

        $data ['id'] = $id;

        if($res1['type'] == 1){

            $data ["title"] = htmlspecialchars ( request()->input('form_title') );
            $data["content"] = request()->input('id-html-code');
            $data['markdown'] = request()->input('id-markdown-doc');
        }else{

            $data ["title"] = htmlspecialchars ( request()->input('form_title'));
            $data ["content"] = htmlspecialchars ( request()->input('form_article'));

        }


        $this->fieldLengthCheck ( $data ["title"], "标题", 100 );


        $pid = request()->input('form_category');

        $info = Category::where(['id'=>$pid])->first();

        if (! $info) {
            $this->formErrorReferer ( "非法操作" );
        }
        $info = $info->toArray();

        $data ['bpath'] = $info ['path'] . '-' . $pid;


        $res = Article::where(['id'=>$id])->update($data);

        if ($res) {
            // 标签管理添加

            $key = new KeywordController();
            $key->updateCategory ( "article", $id, $_REQUEST ["form_tag"] );
            $this->formSuccess ( "修改文章", "/article/index" );
        } else {
            $this->formErrorReferer ( "修改文章" );
        }
    }

    // 详情页
    public final function detail() {
        $id = request()->input('id');

        if (empty ( $id )) {
            abort(404);
        }

        $id = $this->decodeId ( $id );


        // 搜索文章
        $res = Article::where(['article.id'=>$id])
            ->join('user', 'article.uid', '=', 'user.id')
            ->select('article.*','user.name')
            ->first();

        if ($res) {
            $res = $res->toArray();

            $res ["title"] = htmlspecialchars_decode ( $res ["title"] );
            $res ["content"] = htmlspecialchars_decode ( $res ["content"] );
            $this->assign ( 'article', $res );
            $this->assign ( 'article_pre', $this->predata ( $id ) );
            $this->assign ( 'article_next', $this->nextdata ( $id ) );

            //更新文章访问量
            Article::where(['id'=>$id])->increment('visit');

            $cid = explode('-',$res['bpath']);
            $this->assign('this_category', $cid[1]);
            $this->assign('website_title',$res ["title"]);

            return view('article.detail');

        } else {
            abort(404);
        }
    }


    // 查找文章
    public final function search() {

        $begin = microtime(true);

        $category = request()->input('category','');

        if(empty($category))
        {
            $category = session('article.search.word');
        }else{
            session(['article.search.word'=>$category]);

        }

        if ( preg_match('/^\d(.*?)/',$category)!=false and $category > 0) {

            $result = Category::where(['id'=>$category])->first();
            if(!$result)
            {
                goto search_fail;

            }
            $res = $result->toArray();

            $path = $res ['path'] . "-" . $category;
            $search_name = $res['name'];

        }
        elseif(is_string($category)&& !empty($category)){

            $result = Category::where(['name'=>$category])->first();
            if(!$result)
            {
                goto search_fail;
            }
            $res = $result->toArray();

            $path = $res ['path'] . '-' . $res['id'];
            $search_name = $res['name'];

        }else{
            goto search_fail;
        }

search:
        $articles = Article::where(['isdel'=>0])
            ->where('bpath','like',$path.'%')
            ->join('user', 'article.uid', '=', 'user.id')
            ->select('article.*','user.name')
            ->paginate(10);

        if($articles->total() > 0)
        {
            $data = ($articles->toArray())['data'];

            foreach ($data as $k => $v) {
                $data [$k] ['content'] = strip_tags(htmlspecialchars_decode($v ['content']));

                $data [$k] ['id'] = $this->encodeId($v ['id']);

            }
            $this->assign('website_title', '搜索文章结果');
            $this->assign('article_list', $data);
            $this->assign('articles', $articles);

            $this->assign('search_name', $search_name);

            $need_time = microtime(true) - $begin;

            $need_time = sprintf("%4.f", $need_time);

            $this->assign('need_time', $need_time);
            $this->assign('this_category', $category);

            return view('article.search');
        }

search_fail:

        $this->formErrorReferer('没有搜索到文章');

    }



    /*
     * @param $id 当前数据id @param $table 搜索的表 @return 返回上一条数据的字符串
     */
    public function predata($id) {

        $maxid = Article::orderBy('id','desc' )->limit ( 1 )->select('id','title')->first()->toArray();

        $id = $id + 1;
        $array = array ();
        while ( true ) {
            $result = Article::where (['id'=>$id,'isdel' => 0] )
                ->select('id','title')->first();

            if ($result) {
                $array ["id"] = $this->encodeId ( $id );
                $array ["title"] = ($result->toArray()) ["title"];
                break;
            }
            ++$id;
            if ($id > $maxid ['id']) {

                break;
            }
        }
        return $array;
    }

    /*
     * @param $id 当前数据id @param $table 搜索的表 @return 返回下一条数据的字符串
     */
    public function nextdata($id) {

        $id = $id - 1;
        $minid = Article::orderBy( 'id', 'asc' )->limit ( 1 )->select('id','title')->first()->toArray();

        $array = array ();
        while ( true ) {
            $result = Article::where ( ['id'=>$id,'isdel' => 0]  )->select('id','title')->first();

            if ($result) {
                $array ["id"] = $this->encodeId ( $id );
                $array ["title"] = ($result->toArray()) ["title"];
                break;
            }
            --$id;
            if ($id < $minid['id']) {

                break;
            }
        }
        return $array;
    }


    public function youyan()
    {
        $content = file_get_content('http://v2.uyan.cc/code/uyan.js?uid=2141182');
        return $content;
    }
}