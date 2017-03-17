<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/15
 * Time: 下午3:55
 */

namespace App\Http\Controllers\Web;

use App\Model\Document;


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
}