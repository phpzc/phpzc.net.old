<?php
use Phalcon\Mvc\View;
use Phalcon\Http\Response;

class ApiController extends RpcController
{

    /**
     * forward to target Controller and Action
     */
    public function indexAction()
    {


    }

    protected function _empty()
    {
        $this->response->setStatusCode(404, "Not Found");
    }

    protected function callTargetApi()
    {
        $parse = $this->getControllerAction();
        list($controller,$action) = $parse;
        if(!ApiUrl::checkApi($controller,$action)){
            $this->_empty();
            return;
        }
        $this->dispatcher->forward($parse);
    }
}

