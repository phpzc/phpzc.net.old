<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/15
 * Time: 下午3:55
 */

namespace App\Http\Controllers\Web;

use App\Model\Category;
use App\Model\Document;
use Illuminate\Http\Request;

class DocumentController extends CommonController
{
    /*
   * @brief 设置每一页标题
   */
    public function _initialize() {
        parent::_initialize ();
        $action_name = strtolower ( getCurrentMethod() );
        switch ($action_name) {
            case 'index' :
                $this->assign ( 'website_title', '文档' );
                break;
        }
    }

    // 遍历列表 前20个文档资料
    public final function index() {

        $result = Document::where(['isdel'=>0])
            ->orderBy('id','desc')
            ->paginate(8);

        $this->assign('documents',($result->toArray())['data']);
        $this->assign('page',$result->links());
        return view('document.index');

    }

    // 创建文档资料
    public final function create() {
        $this->formLoginCheck ();
        if( session('id') == 1){
            return view('document.create');
        }
    }


    public final function dealCreate(Request $request) {

        $this->formLoginCheck ();

        $length = getLength (  request()->input('form_title') );
        if ($length > 100) {
            $this->formErrorReferer ( "标题长度不能超过100个字" );
        }
        if ($length < 1) {
            $this->formErrorReferer ( "标题不能为空" );
        }
        $length = getLength ( request()->input('form_author'));
        if ($length > 100) {
            $this->formErrorReferer ( "作者长度不能超过100个字" );
        }
        if ($length < 1) {
            $this->formErrorReferer ( "作者不能为空" );
        }
        $length = getLength ( request()->input('url') );
        if ($length > 200) {
            $this->formErrorReferer ( "网盘地址长度不能超过200个字" );
        }
        if ($length < 1) {
            $this->formErrorReferer ( "网盘地址不能为空" );
        }

        $data ["content"] = htmlspecialchars ( request()->input('content') );
        $length = getLength ( request()->input('content') );
        if ($length > 10000) {
            $this->formErrorReferer ( "内容长度不能超过10000个字" );
        }
        if ($length < 1) {
            $this->formErrorReferer ( "内容不能为空" );
        }

        $imgurl = $request->file('upload')->store('avatars');

        $data ["title"] = htmlspecialchars ( request()->input('form_title') );

        $data ["author"] = htmlspecialchars ( request()->input('form_author'));
        $data ["imgurl"] = NET_NAME.'/storage/app/'.$imgurl;
        $data ["urltype"] = ( int ) request()->input('urltype');
        $data ["doctype"] = ( int ) request()->input('doctype');
        $data ["url"] = htmlspecialchars ( request()->input('url') );
        $data ["time"] = time ();
        $data ["uid"] = session('id');
        $pid = request()->input('form_category');


        $info = Category::where(['id'=>$pid])->first()->toArray();
        $data ['bpath'] = $info ['path'] . '-' . $pid;
        $data ['year'] = date ( 'Y', $data ['time'] );
        $data ['month'] = date ( 'm', $data ['time'] );
        $data ['ip'] = ip2long ( $_SERVER ["REMOTE_ADDR"] );

        $res = Document::insertGetId($data);
        if ($res) {
            // 标签管理添加
            $key = new KeywordController();
            $key->automake ( $res, request()->input('form_tag'), 'document' );
            $this->formSuccess ( "新增资料", "/document/create" );
        } else {
            $this->formError ( "新增资料", "/document/create" );
        }
    }
}