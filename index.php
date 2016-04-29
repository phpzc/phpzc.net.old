<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件
$access_site_name = $_SERVER['HTTP_HOST'];

if (stripos($access_site_name,'newblog') === false) {

    // 3.2启动环境

    // 检测PHP环境
    if (version_compare(PHP_VERSION, '5.3.0', '<')) die('require PHP > 5.3.0 !');

    // 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
    define('APP_DEBUG', True);

    // 定义应用目录
    define('APP_PATH', './Application/');

    // 定义绑定模块
    //define('BIND_MODULE','Admin');
    define('BIND_MODULE', 'App');

    //引入公共的常量文件
    define('ROOT_PATH', realpath(dirname(__FILE__)));

    //

    require ROOT_PATH . "/sina/Sina.php";

    // 引入ThinkPHP入口文件
    require './ThinkPHP/ThinkPHP.php';

    // 亲^_^ 后面不需要任何代码了 就是如此简单


} else {
//================================================

    /* TP5.0*/
    // 检测PHP环境
    if (version_compare(PHP_VERSION, '5.4.0', '<')) die('require PHP > 5.4.0 !');


    //引入公共的常量文件
    define('ROOT_PATH', realpath(dirname(__FILE__)));

    require ROOT_PATH . "/sina/Sina.php";

    // 定义应用目录
    define('APP_PATH', __DIR__ . '/ThinkPHP5.0/application/');
    // 开启调试模式
    define('APP_DEBUG', false);

    // 加载框架引导文件
    require __DIR__ . '/ThinkPHP5.0/thinkphp/start.php';
}