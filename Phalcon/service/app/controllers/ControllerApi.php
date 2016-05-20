<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/20
 * Time: 10:25
 */

/**
 * Class ControllerApi
 *          check api token expire time
 *
 *          only extends by controller for api
 *
 * @todo api request create a lot session
 *
 */
class ControllerApi extends RpcController
{
    protected function initialize()
    {
        $access_token = $this->getToken();

        if(empty($access_token)){
            $this->errorReturn(Api::SYS_INVALID_TOKEN,AM(Api::SYS_INVALID_TOKEN).'--Base');
        }

        $ttl = RC()->ttl(Constants::TOKEN_KEY_PREFIX.$access_token);
        if($ttl < 60){
            $this->errorReturn(Api::SYS_INFO_WILE_EXPIRE,AM(Api::SYS_INFO_WILE_EXPIRE));
        }
    }

    protected function getToken()
    {
        if($this->request->isGet() ){

            return $this->request->get('access_token');
        }else {

            return $this->request->getPost('access_token');
        }
    }
}