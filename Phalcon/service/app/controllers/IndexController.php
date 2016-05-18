<?php

class IndexController extends ControllerBase
{

    /**
     * 设置标题
     * @param $dispatcher
     */
    public function beforeExecuteRoute($dispatcher)
    {
        /**
         * 设置页面 标题
         */
        if($dispatcher->getActionName() == 'index'){
            $this->tag->setTitle($this->L('index_title'));
        }

    }
    public function indexAction()
    {

        $this->session->destroy();
        
    }

}

