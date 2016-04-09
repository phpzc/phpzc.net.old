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
    private static $language = 'zh';

    /**
     * @var array 语言词组
     */
    private static $words = array();


    /**
     * 设置语言
     * @param $language
     */
    public static function setLanguage($language)
    {
        self::$language = $language;
    }

    /**
     * 载入词组
     */
    public static function load()
    {
        self::$words[self::$language] = require dirname(__FILE__).'/'.self::$language.'/word.php';

    }

    /**
     * 读取词语
     * @param $name
     * @param string $language
     * @return mixed
     */
    public static function R($name,$language = ''){
        if(empty($language)){
            $language = self::$language;
        }
        return self::$words[$language][$name];
    }



    /**
     * 修正词语
     * @param $name
     * @param $value
     * @param string $language
     */
    public static function W($name,$value,$language = '')
    {
        if(empty($language)){
            $language = self::$language;
        }
        self::$words[$language][$name] = $value;
    }


}