<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/28
 * Time: 16:21
 */

namespace App\Service;

class Service
{
    public function __construct()
    {
        if(method_exists($this,'_init')){
            $this->_init();
        }
    }
}