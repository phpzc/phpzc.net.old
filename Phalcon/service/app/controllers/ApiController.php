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

        $this->callTargetApi();
    }

    protected function _empty()
    {
        $this->response->setStatusCode(404, "Not Found");
    }

    protected function callTargetApi()
    {

        $parse = $this->getControllerAction();

        $controller = $parse['controller'];
        $action =$parse['action'];
        if(!ApiUrl::checkApi($controller,$action)){
            $this->_empty();
            return;
        }
        $this->dispatcher->forward($parse);
    }
    

    public function access_tokenAction()
    {

        $app_key = $this->request->get('app_key');
        $app_secret = $this->request->get('app_secret');

        if(!$this->getIdentity($app_key,$app_secret))
        {
            $this->errorReturn(Api::SYS_INVALID_KEY_SECRET,
                AM(Api::SYS_INVALID_KEY_SECRET));
        }

        $token = $this->setToken();

        if($token){
            $this->rpcReturn(array(
                'access_token'=>$token,
                'expire_time'=>Constants::TOKEN_EXPIRE_TIME
            ));
        }else{
            $this->errorReturn(Api::SYS_SET_TOKEN_ERROR,
                AM(Api::SYS_SET_TOKEN_ERROR));
        }
    }


    public function refresh_tokenAction()
    {
        $old_token = $this->request->get('access_token');

        $old = RC()->get(Constants::TOKEN_KEY_PREFIX.$old_token);

        if($old){
            $token = $this->setToken();

            if($token) {
                RC()->expire(Constants::TOKEN_KEY_PREFIX . $old_token,5);// protected for some things happen in one time
                $this->rpcReturn(array(
                    'access_token' => $token,
                    'expire_time'=>Constants::TOKEN_EXPIRE_TIME
                ));

            }else {
                $this->errorReturn(Api::SYS_SET_TOKEN_ERROR,
                    AM(Api::SYS_SET_TOKEN_ERROR));
            }

        }else{
            $this->errorReturn(
                Api::SYS_INVALID_OLD_TOKEN,
                AM(Api::SYS_INVALID_OLD_TOKEN)
            );
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
        return in_array(sha1($app_id.'-'.$app_secret),ApiUrl::APP_IDENTITY);

    }

    protected function setToken()
    {
        $token = $this->genAccessToken();
        
        if(RC()->set(Constants::TOKEN_KEY_PREFIX.$token,1,Constants::TOKEN_EXPIRE_TIME))
            return $token;
        else
            return false;
    }
    /**
     * 生成token串
     * @return string
     */
    protected function genAccessToken() {
        return md5(base64_encode(pack('N6', mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), uniqid())));
    }



}

