<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'     => 'App', //默认模块
    'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
    'DEFAULT_C_LAYER'       =>  'Action', // 默认的控制器层名称
    'DEFAULT_V_LAYER'       =>  'Tpl', // 默认的视图层名称

    'TMPL_PARSE_STRING'  =>array(
        '__JS__' => '/Public/js', // 增加新的JS类库路径替换规则
        '__UPLOAD__' => '/Public/Uploads', // 增加新的上传路径替换规则
        '__CSS__'=>'/Public/css',
        '__CUBE__' => '/Public/cube',
        '__PHPJS__' => '/Public/phpjs/functions',
        '__UEDITOR__' => '/Public/baidu/UEditor',
    ),
);
