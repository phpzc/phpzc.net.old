<?php

use Phalcon\Mvc\Controller;

use Phalcon\Translate\Adapter\NativeArray;

class ControllerBase extends Controller
{
    /**
     * @var 语言对象
     */
    protected $_language;

    /**
     * 执行项目初始化工作
     *
     *  1   设置语言包
     */
    public function onConstruct()
    {

        $this->_setLanguage();
    }

    /**
     * 设置语言
     */
    protected function _setLanguage()
    {
        // Ask browser what is the best language
        $language = $this->request->getBestLanguage();

        // Check if we have a translation file for that lang
        if (file_exists(APP_PATH."/app/messages/" . $language . ".php")) {
            $messages = require APP_PATH."/app/messages/" . $language . ".php";
        } else {
            // Fallback to some default
            $messages = require APP_PATH."/app/messages/en.php";
        }

        // 设置视图层 语言变量
        $this->_language = new NativeArray(
            array(
                "content" => $messages
            )
        );
    }


    /**
     * 设置标题前置
     *
     * 设置语言包到模板变量
     *
     *
     */
    protected function initialize()
    {

        $this->tag->prependTitle(Constants::SITE_TITLE);
        $this->view->t =  $this->_language;

    }

    /**
     * 语言包字符串
     *
     * @param $key
     * @return string
     */
    protected function L($key)
    {
        return $this->_language->_($key);
    }


}
