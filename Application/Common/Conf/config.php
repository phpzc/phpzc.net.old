<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'     => 'Home', //默认模块    
    'URL_MODEL'          => '2', //URL模式    
    'SESSION_AUTO_START' => true, //是否开启session
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(    
        'index/:id'=>array('index/index','',array('ext'=>'html')),
    ),

);
