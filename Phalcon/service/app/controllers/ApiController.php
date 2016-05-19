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


    public function access_tokenAction()
    {
        $app_id = $this->request->get('app_id');
        $app_secret = $this->request->get('app_secret');

        if($this->getIdentity($app_id,$app_secret))
        {
            $this->rpcReturn(array(
                'error_code'=>'',
                'error_message'=>'',
            ));
        }
    }


    /**
     * 获取身份
     * @param $app_id
     * @param $app_secret
     * @todo
     * @return bool
     */
    protected function getIdentity($app_id,$app_secret)
    {
        return in_array(sha1($app_id.'-'.$app_secret),ApiUrl::ALL_API);
    }
}

