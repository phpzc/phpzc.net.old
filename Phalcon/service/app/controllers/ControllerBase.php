<?php

use Phalcon\Mvc\Controller;

use Phalcon\Translate\Adapter\NativeArray;

class ControllerBase extends Controller
{
    const CACHE_TIME = 86400; //1天
    const CACHE_CATEGORY_TIME = 604800;// 7天
    public $_userId = 0;

    public function setId($id)
    {
        $this->_userId = $id;
    }

    public function getId()
    {
        return $this->_userId;
    }

    /**
     * @var 语言对象
     */
    protected $_language;

    /**
     * 执行项目初始化工作
     *
     *  1   设置语言包
     */
    public function onConstruct()
    {

        $this->_setLanguage();
    }

    /**
     * 设置语言
     */
    protected function _setLanguage()
    {
        // Ask browser what is the best language
        $language = $this->request->getBestLanguage();

        // Check if we have a translation file for that lang
        if (file_exists(APP_PATH . "/app/messages/" . $language . ".php")) {
            $messages = require APP_PATH . "/app/messages/" . $language . ".php";
        } else {
            // Fallback to some default
            $messages = require APP_PATH . "/app/messages/en.php";
        }

        // 设置视图层 语言变量
        $this->_language = new NativeArray(
            array(
                "content" => $messages
            )
        );
    }


    /**
     * 设置标题前置
     *
     * 设置语言包到模板变量
     *
     *
     */
    protected function initialize()
    {

        $this->tag->prependTitle(Constants::SITE_TITLE);
        $this->view->L = $this->_language;

        $this->view->THIS_CONTROLLER = '';
        $this->view->WebsiteCategory = array();
        $this->view->this_category = '';
        $this->view->soft_type = '';
        $this->view->WEBSITE = array('CONTROLLER_NAME' => '', 'url' => '');
        $this->view->bread_crumbs = '';

        $this->_initApp();
    }

    /**
     * 语言包字符串
     *
     * @param $key
     * @return string
     */
    protected function L($key)
    {
        return $this->_language->_($key);
    }

    /*
     * 加密id
     */
    public function encodeId($id)
    {
        $mid = md5($id);
        $str = substr($mid, 0, 16);
        $str .= $id;
        $str .= substr($mid, 16, 16);
        return $str;
    }

    /*
     * 解密id
     */
    public function decodeId($id)
    {
        $len = strlen($id);
        $str = substr($id, 16, $len - 32);
        return $str;
    }

    /*
     * 从文件取得cache数组
     * */
    public function getCacheArray($path, $name)
    {
        $file = APP_PATH.'/app/cache/';
        $target = $file . $path . '/' . md5($name) . '.php';
        $fpath = $file . $path;
        if (!is_dir($fpath)) {
            if (!mkdir($fpath, 0777, true)) {
                return false;
            }
        }

        if (!is_file($target)) {
            return false;
        }
        $compare_time = 0;
        if ($path == 'category') {
            $compare_time = self::CACHE_CATEGORY_TIME;
        } else {
            $compare_time = self::CACHE_TIME;
        }

        if (filectime($target) < time() - $compare_time) {
            @unlink($target);
            return false;
        }


        $arr = array();
        $arr = require_once $target;

        return $arr;
    }

    /*
     * 保存cache数据到文件
     * */
    public function saveCacheArray($path, $name, $data)
    {
        $file = APP_PATH.'/app/cache/';
        $target = $file . $path . '/' . md5($name) . '.php';
        $fpath = $file . $path;
        if (!is_dir($fpath)) {
            if (!mkdir($fpath, 0777, true)) {
                return false;
            }
        }

        if (is_file($target)) {
            @unlink($target);
        }
        $str = "<?php return ";
        $str .= var_export($data, true);
        $str .= ";";

        if (!is_writable($target)) {
            chmod($fpath, 0777);
        }

        if (file_put_contents($target, $str)) {
            return true;
        } else {
            return false;
        }


    }

    protected function _initApp()
    {
        // 分配网站名称
        $_WEBSITE ["url"] = '';
        $_WEBSITE ["url_short"] = $_SERVER['HTTP_HOST'];
        $_WEBSITE ["name"] = "PeakPointer";
        $_WEBSITE['CONTROLLER_NAME'] = '';
        $_WEBSITE['ACTION_NAME'] ='';
        $this->assign ( "WEBSITE", $_WEBSITE );
        // form code
        if (! $this->session->has('form.code') ) {
            $this->session->set('form.code',md5 ( microtime(true).rand() )) ;
        }

        // 分类
        //
        if (! $this->session->has("website.category")) {
            //如果存在
            $tmpArr= $this->getCacheArray("category", "category");
            if($tmpArr != false){
                $this->session->set("website.category",$tmpArr) ;
            }else{
                //不存在

                $r = Category::find("pid=0");
                $r = $r->toArray();
                $flag = $this->saveCacheArray("category", "category", $r );
                if($flag){
                    $this->session->set("website.category",$r) ;
                }
            }

        }
        $this->assign ( "WebsiteCategory", $this->session->get("website.category") );

        /*
        // 标签 关键字
        if (! isset ( $_SESSION ["website"] ["tag"] )) {
            $c = M ( 'Keyword' );
            $r = $c->select ();
            $_SESSION ["website"] ["tag"] = $r;
        }
        // dump($_SESSION["website"]["tag"]);
        $this->assign ( "WebsiteTag", $_SESSION ["website"] ["tag"] );


        //查找热门资料
        if ( !isset($_SESSION["website"]["cache"]["article_rank"]))
        {
            //如果存在
            $tmpArr= $this->getCacheArray("common", "article_rank");
            if($tmpArr != false){
                $_SESSION["website"]["cache"]["article_rank"] = $tmpArr;
            }else{
                //不存在
                $articleModle = M("Article");
                $res = $articleModle->where("isdel = 0")->field("id,title")->order("visit desc,id desc")->limit(18)->select();
                foreach ($res as $k=>$v){
                    $res[$k]["realid"] = $v["id"];
                    $res[$k]["id"] = $this->encodeId($v["id"]);
                    switch($k){
                        case 0:
                        case 1:
                        case 2:
                            $res[$k]["class"] = $k+1;
                            $res[$k]["index"] = $k+1;
                            break;
                        default:
                            $res[$k]["class"] = "More";
                            $res[$k]["index"] = $k+1;
                            break;
                    }
                }
                $flag = $this->saveCacheArray("common", "article_rank", $res);
                if($flag){
                    $_SESSION["website"]["cache"]["article_rank"] = $res;
                }else{

                }
            }
        }
        $this->assign ( "WebsiteCacheArticle", $_SESSION["website"]["cache"]["article_rank"]);

        //查找热门文档
        if ( !isset($_SESSION["website"]["cache"]["document_rank"]))
        {
            //如果存在
            $tmpArr= $this->getCacheArray("common", "document_rank");
            if($tmpArr != false){
                $_SESSION["website"]["cache"]["document_rank"] = $tmpArr;
            }else{
                //不存在
                $articleModle = M("Document");
                $res = $articleModle->where("isdel = 0")->field("id,title,url")->order("visit desc,id desc")->limit(18)->select();
                foreach ($res as $k=>$v){

                    $res[$k]["id"] = $this->encodeId($v["id"]);
                    switch($k){
                        case 0:
                        case 1:
                        case 2:
                            $res[$k]["class"] = $k+1;
                            $res[$k]["index"] = $k+1;
                            break;
                        default:
                            $res[$k]["class"] = "More";
                            $res[$k]["index"] = $k+1;
                            break;
                    }
                }
                $flag = $this->saveCacheArray("common", "document_rank", $res);
                if($flag){
                    $_SESSION["website"]["cache"]["document_rank"] = $res;
                }else{

                }
            }
        }

        $this->assign ( "WebsiteCacheDocument", $_SESSION["website"]["cache"]["document_rank"]);

        */
        //分配 用户id
        if($this->session->has('Auth.id')){
            $this->_userId = $this->session->get('Auth.id');
        }

    }


    protected function assign($key,$value = ''){
        if(is_array($key)){
            foreach ($key as $k=>$v){
                $this->view->$k = $v;
            }
        }elseif(is_string($key)){
            $this->view->$key = $value;
        }

    }
}
