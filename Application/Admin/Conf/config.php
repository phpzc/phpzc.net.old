<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2015/12/18
 * Time: 0:14
 */
return array(
    //'DEFAULT_MODULE' => 'Admin',
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