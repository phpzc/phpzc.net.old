<?php
use Phalcon\Mvc\View;
class RpcController extends ControllerBase
{
    /**
     * 设置视图显示级别
     * @param $dispatcher \Phalcon\Dispatcher
     */
    public function beforeExecuteRoute($dispatcher)
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);

        
    }

    /**
     *  接口请求完毕后 追加日志
     * @param $dispatcher
     */
    public function afterExecuteRoute($dispatcher)
    {
        $this->session->destroy();
    }

    public function indexAction()
    {
        $this->rpcReturn(array('test'=>1));
    }

    protected function rpcReturn($data)
    {
        $this->view->setRenderLevel(View::LEVEL_BEFORE_TEMPLATE);
        $accept = $this->request->getHeader('Accept') || $this->request->getHeader('accept');
        $accept = strtolower($accept);

        if(strpos($accept,'json') !== false){
            echo json_encode($data,true);
        }else{
            //echo $this->xml_encode($data);
            echo json_encode($data,true);
        }

        $this->afterExecuteRoute($this->dispatcher);
        exit;
    }

    protected function errorReturn($code,$message,$data = null)
    {
        $response = array('error_code'=>$code,'error_message'=>$message);
        if(!empty($data)){
            $response['data'] =$data;
        }

        $this->rpcReturn($response);
    }

    protected function getControllerAction()
    {
        $url = $this->request->getURI();

        preg_match('%/api/index/(\w+)/(\w+)/{0,}%',$url,$matches);

        return array(
            'controller'=>$matches[1],
            'action'=>$matches[2],
        );

    }

    /**
     * XML编码
     * @param mixed $data 数据
     * @param string $root 根节点名
     * @param string $item 数字索引的子节点名
     * @param string $attr 根节点属性
     * @param string $id   数字索引子节点key转换的属性名
     * @param string $encoding 数据编码
     * @return string
     */
    protected function xml_encode($data, $root='phalcon', $item='item', $attr='', $id='id', $encoding='utf-8') {
        if(is_array($attr)){
            $_attr = array();
            foreach ($attr as $key => $value) {
                $_attr[] = "{$key}=\"{$value}\"";
            }
            $attr = implode(' ', $_attr);
        }
        $attr   = trim($attr);
        $attr   = empty($attr) ? '' : " {$attr}";
        $xml    = "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>";
        $xml   .= "<{$root}{$attr}>";
        $xml   .= $this->data_to_xml($data, $item, $id);
        $xml   .= "</{$root}>";
        return $xml;
    }

    /**
     * 数据XML编码
     * @param mixed  $data 数据
     * @param string $item 数字索引时的节点名称
     * @param string $id   数字索引key转换为的属性名
     * @return string
     */
    protected function data_to_xml($data, $item='item', $id='id') {
        $xml = $attr = '';
        foreach ($data as $key => $val) {
            if(is_numeric($key)){
                $id && $attr = " {$id}=\"{$key}\"";
                $key  = $item;
            }
            $xml    .=  "<{$key}{$attr}>";
            $xml    .=  (is_array($val) || is_object($val)) ? $this->data_to_xml($val, $item, $id) : $val;
            $xml    .=  "</{$key}>";
        }
        return $xml;
    }
}

