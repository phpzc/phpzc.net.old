<?php

/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/20
 * Time: 10:47
 */
class TestController extends ControllerApi
{
    public function index()
    {
        $this->rpcReturn(['test_data'=>1]);
    }
}