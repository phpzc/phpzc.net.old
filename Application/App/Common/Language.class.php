<?php
/**
 * Created by PhpStorm.
 * User: PeakPointer
 * Date: 2016/4/9
 * Time: 21:20
 */

namespace App\Common;

/**
 * 自定义语言加载类
 * Class Language
 * @package App\Common
 */
class Language
{

    /**
     * @var string 语言种类 zh 和 en
     */
    private  $language = 'zh';

    /**
     * @var array 语言词组
     */
    private  $words = array();


    /**
     * 设置语言
     * @param $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * 载入词组
     */
    public function load()
    {
        $this->words[$this->language] = require APP_PATH.'App/Common/'.$this->language.'/word.php';

    }

    /**
     * 读取词语
     * @param $name
     * @param string $language
     * @return mixed
     */
    public function R($name,$language = ''){
        if(empty($language)){
            $language = $this->language;
        }
        return $this->words[$language][$name];
    }



    /**
     * 修正词语
     * @param $name
     * @param $value
     * @param string $language
     */
    public function W($name,$value,$language = '')
    {
        if(empty($language)){
            $language = $this->language;
        }
        $this->words[$language][$name] = $value;
    }


}