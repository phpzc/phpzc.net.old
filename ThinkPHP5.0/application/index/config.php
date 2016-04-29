<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/29
 * Time: 9:43
 */

return [
    'view_replace_str' => [
        '__PUBLIC__' => '/Public',

        '__JS__' => '/Public/js', // 增加新的JS类库路径替换规则
        '__UPLOAD__' => '/Public/Uploads', // 增加新的上传路径替换规则
        '__CSS__'=>'/Public/css',
        '__CUBE__' => '/Public/cube',
        '__PHPJS__' => '/Public/phpjs/functions',
        '__UEDITOR__' => '/Public/baidu/UEditor',
        '__KINDEDITOR__' => '/Public/kindeditor',
    ],
    'template' => [
        //标签库标签开始标签
        'taglib_begin'  =>  '<',
        //标签库标签结束标记
        'taglib_end'    =>  '>',

        //布局
        'layout_on'=>true,
        'layout_name'=>'Layout/main',
    ],

    // 是否开启多语言
    'lang_switch_on'         => false,
    // 支持的多语言列表
    'lang_list'              => ['zh-cn','en-us'],
];