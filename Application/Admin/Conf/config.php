<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2015/12/18
 * Time: 0:14
 */
return array(

    //'配置项'=>'配置值'
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => '127.0.0.1', // 服务器地址
    'DB_NAME'               => 'sq_vipmhxy',          // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => 'root',          // 密码
    'DB_PORT'               => '3306',        // 端口
    'DB_PREFIX'             => 'vip_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    => false,       // 是否进行  字段类型检查
    'DB_FIELDS_CACHE'       => false,        // 启用字段缓存
    'DB_CHARSET'            => 'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        => 0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        => false,       // 数据库读写是否分离 主从式有效

    'DB_SQL_BUILD_CACHE'    => false, // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    => 'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   => 20, // SQL缓存的队列长度
    'ACTION_CACHE_ON'  => false,
    'TMPL_CACHE_ON'    => false,
    'HTML_CACHE_ON'   => false,//
    //'SHOW_ERROR_MSG'        => true,    // 显示错误信息
    'URL_CASE_INSENSITIVE'  =>true,
    //'SHOW_PAGE_TRACE'        =>true,
    'URL_HTML_SUFFIX'=>'.html',

    'DEFAULT_MODULE' => 'Admin',
    'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
    'DEFAULT_V_LAYER'       =>  'View', // 默认的视图层名称
    'SESSION_PREFIX'        =>  'Admin_',
    'TMPL_PARSE_STRING'  =>array(
        '__JS__' => '/Public/js', // 增加新的JS类库路径替换规则
        '__UPLOAD__' => '/Public/Uploads', // 增加新的上传路径替换规则
        '__CSS__'=>'/Public/css',
        '__ADMIN__' => '/Public/admin',
        '__PHPJS__' => '/Public/phpjs/functions',
        '__UEDITOR__' => '/Public/baidu/UEditor',
    ),
);