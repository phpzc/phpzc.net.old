<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:41
 */

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Model\Category;
use App\Model\Keyword;
use App\Model\Project;
use App\Model\ProjectSummary;
use App\Model\Article;

class CommonController extends Controller
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

    public function __construct()
    {
        $this->_initialize();

        $this->_init();
    }

    public function _init()
    {
        //子类实现自身方法
    }

    /**
     * 分配模板变量
     *
     * @param $key
     * @param $value
     */
    protected function assign($key, $value)
    {
        view()->share($key, $value);
    }


    public function _initialize()
    {

        $_WEBSITE["url"] = NET_NAME;
        $_WEBSITE["url_short"] = $_SERVER['HTTP_HOST'];
        $_WEBSITE["name"] = "张成的官方网站";
        $_WEBSITE['CONTROLLER_NAME'] = getCurrentController();
        $_WEBSITE['ACTION_NAME'] = getCurrentMethod();


        $this->assign("WEBSITE", $_WEBSITE);

        if( !request()->session()->has('website.category'))
        {
            //如果存在
            $tmpArr = $this->getCacheArray("category", "category");
            if ($tmpArr != false) {
                request()->session()->put('website.category',$tmpArr);
            } else {

                $r = Category::where('pid',0)->get()->toArray();

                $flag = $this->saveCacheArray('category', 'category', $r);
                if ($flag) {

                    request()->session()->put('website.category',$r);
                } else {

                }
            }
        }

        $this->assign("WebsiteCategory", session('website.category'));

        // 标签 关键字
        if( !request()->session()->has('website.tag'))
        {
            $r = Keyword::all()->toArray();
            request()->session()->put('website.tag',$r);
        }

        $this->assign("WebsiteTag", session('website.tag'));


        //分配project
        //assign project menu
        if (!request()->session()->has('website.menu_project')
        ) {

            $allProject = Project::all()->toArray();

            foreach ($allProject as $k=>$v2) {

                $summary = ProjectSummary::where('project_id',$v2['project_id'])->get()->toArray();

                foreach ($summary as $k2=>$v) {

                    if(!$v['article_id_data'])
                    {

                        $summary[$k2]['sub_data'] = [];
                        continue;
                    }

                    $subData = Article::whereIn('id', explode(',',$v['article_id_data']))->select('title','id')->get()->toArray();
                    $summary[$k2]['sub_data'] = $subData;
                }

                $allProject[$k]['summary'] = $summary;

            }

            request()->session()->put('website.menu_project',$allProject);
        }

        $this->assign('MENU_PROJECT',
            session('website.menu_project'));

        //分配 用户id
        if ( ! request()->session()->has('id') ) {
            $this->_userId = session('id');
        }


        //分配nginx源码目录变量
        if (! request()->session()->has('website.cache.nginx_source_code'))
        {
            //如果存在
            $tmpArr = $this->getCacheArray("common", "nginx_source_code");
            if ($tmpArr != false) {

                request()->session()->put('website.cache.nginx_source_code',$tmpArr);
            } else {
                //实时生成数据到数组 保存入文件
                $res = [];

                $prefix = '/project/';
                $dir = 'nginx';

                $this->fetchDirSetData($res, $prefix . $dir, $dir);

                $flag = $this->saveCacheArray("common", "document_rank", $res);
                if ($flag) {
                    request()->session()->put('website.cache.nginx_source_code',$res);
                }
            }
        }

        $this->assign('WebsiteCacheNginx', session('website.cache.nginx_source_code'));

        //分配一些变量

        $this->assignSomeDatas();

        //添加ip记录
        add_ip_record();
    }

    // 跳转函数
    public function formSuccess($title, $url = '/', $sec = 3)
    {
        $url = trim($url, '/');
        $url = '/' . $url;
        $string = '?title=' . $title . '&url=' . base_encode(get_site_url() . $url) . '&sec=' . $sec;
        header('location:'.get_site_url()  . '/form/success' . $string);
        exit ();
    }


    public function formError($title, $url = '/', $sec = 3)
    {

        $url = trim($url, '/');
        $url = '/' . $url;

        $string = '?title=' . $title . '&url=' . base_encode(get_site_url() . $url) . '&sec=' . $sec;
        header('location:'.get_site_url() . '/form/error' . $string);
        exit ();
    }

    public function formErrorReferer($title, $sec = 3)
    {
        if (!empty ($_SERVER ["HTTP_REFERER"])) {
            $string = '?title=' . $title . '&url='  . base_encode($_SERVER ["HTTP_REFERER"]) .  '&sec=' . $sec;
        } else {
            $string = '?title=' . $title . '&url=' . base_encode(get_site_url()) . '&sec='  . $sec;
        }
        header('location:'.get_site_url() . '/form/error' . $string);
        exit ();
    }

    public function formLoginCheck($sec = 3)
    {
        if ( !request()->session()->has('id') ) {
            $this->formErrorReferer('请登录后操作');
        }
    }

    public function fieldLengthCheck(&$var, $desc, $max = 100, $min = 1)
    {
        $length = getLength($var);
        if ($length > $max) {
            $this->formErrorReferer($desc . "长度不能超过" . $max);
        }
        if ($length < $min) {
            $this->formErrorReferer($desc . "不能为空");
        }
    }

    /**
     * 检查数据长度 供json环境使用
     *
     * @param array  $var
     * @param number $max
     * @param number $min
     *
     * @return boolean
     */
    public function jsonLengthCheck(&$var, $max = 100, $min = 1)
    {
        $length = getLength($var);
        if ($length > $max) {
            return true;
        }
        if ($length < $min) {
            return true;
        }

        return false;
    }

    /**
     * 检查是否登陆校验
     *        json返回值
     *
     * @return json
     */
    public function jsonLoginCheck()
    {
        if ( !request()->session()->has('id') ) {
            jsonP('未登陆', 1);
        }
    }

    /*
     * 加密id
     */
    public function encodeId($id)
    {
//        $mid = md5($id);
//        $str = substr($mid, 0, 16);
//        $str .= $id;
//        $str .= substr($mid, 16, 16);
//
//        return $str;
//        return base_encode($id);
        return $id;
    }

    /*
     * 解密id
     */
    public function decodeId($id)
    {
//        $len = strlen($id);
//        $str = substr($id, 16, $len - 32);
//
//        return $str;
//        return base_decode($id);
        return $id;
    }

    /**
     * 从文件取得cache数组
     *
     * @param $path 缓存路径名称
     * @param $name 缓存名字
     *
     * @return array|bool|mixed
     */
    public function getCacheArray($path, $name)
    {
        $file = './cache/';
        $target = $file . $path . '/' .sha1($name) . '.php';
        $fpath = $file . $path;
        if (!is_dir($fpath)) {
            if (!mkdir($fpath, 0777, true)) {
                return false;
            }
        }

        if (!is_file($target)) {
            return false;
        }

        if ($path == 'category') {
            $compare_time = self::CACHE_CATEGORY_TIME;
        } else {
            $compare_time = self::CACHE_TIME;
        }

        if (filectime($target) < time() - $compare_time) {
            @unlink($target);

            return false;
        }

        $data = unserialize( file_get_contents($target) );

        return $data;
    }

    /**
     * 保存cache数据到文件
     *
     * @param $path 文件夹名称路径
     * @param $name 缓存名字 -- 影响实际文件名
     * @param $data 缓存数据
     *
     * @return bool
     */
    public function saveCacheArray($path, $name, $data)
    {
        $file = './cache/';
        $target = $file . $path . '/' . sha1($name) . '.php';
        $fpath = $file . $path;
        if (!is_dir($fpath)) {
            if (!mkdir($fpath, 0777, true)) {
                return false;
            }
        }

        if (is_file($target)) {
            @unlink($target);
        }

        $str = serialize($data);


        if (!is_writable($target)) {
            chmod($fpath, 0777);
        }

        if (file_put_contents($target, $str)) {
            return true;
        } else {
            return false;
        }


    }

    /**
     * 分配一些模板变量
     */
    protected function assignSomeDatas()
    {

        $this->assign('THIS_CONTROLLER', getCurrentController() );
        $this->assign('THIS_ACTION', getCurrentController() . '/' . getCurrentMethod() );
        $this->assign('this_category','');
        $this->assign('THIS_PROJECT_ID','');
        $this->assign('this_id','');
    }


    public function actionReturn($status, $msg = '', $urlOrdata = '')
    {
        $data['status'] = $status;
        $data['content'] = $msg;
        if ($urlOrdata != '') {
            if (is_string($urlOrdata)) {
                $data['url'] = $urlOrdata;
            } elseif (is_array($urlOrdata)) {
                $data['data'] = $urlOrdata;
            }
        }

        $this->ajaxReturn($data);
    }


    public function ajaxReturn($data)
    {
        echo json_encode($data,true);
        exit();
    }


    public function formRootLoginCheck($sec = 3)
    {
        if (!request()->session()->has('id') or session('id') !=1 ) {
            $string = "title=请管理员登录后操作&url=" . base_encode("http://" . $_SERVER ["HTTP_HOST"]) . "&sec=" . $sec;
            header("location:".NET_NAME . '/form/error?' . $string);
            exit ();
        }
    }


    protected function fetchDirSetData(&$res, $dirName, $name)
    {

        $len = count($res);
        if (is_dir($dirName) && ($handle = opendir("$dirName"))) {
            $tmp['is_file'] = 0;
            $tmp['name'] = $name;
            $tmp['file'] = '';
            $tmp['next'] = [];

            $res[ $len ] = $tmp;
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    $this->fetchDirSetData($res[ $len ]['next'], "$dirName/$item", $item);
                }
            }
            closedir($handle);
        } else {
            $tmp['is_file'] = 1;
            $tmp['name'] = $name;
            $tmp['file'] = substr($dirName, 9);
            $tmp['next'] = [];

            $res[ $len ] = $tmp;
        }
    }

}