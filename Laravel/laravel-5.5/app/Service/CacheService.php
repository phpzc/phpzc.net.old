<?php
namespace App\Service;


/**
 * 本类只缓存 查询展示类数据缓存
 * Class CacheService
 * @package App\Service
 */
class CacheService extends Service
{
    const CACHE_KEY_PREFIX = 'CacheService_';

    const CACHE_TTL = 900;//15分钟


    const CACHE_KEY = [
        //'index_index',
    ];

    protected static function getKey($methodNameForKey)
    {
        return self::CACHE_KEY_PREFIX.$methodNameForKey;
    }

    /**
     * 获取服务缓存对象  使用的redis
     * @return \Redis
     */
    protected static function getCacheObject()
    {
        return RC();
    }

    /**
     * 快速删除所有查询数据缓存
     */
    public static function cleanCache()
    {
        $keys = self::getCacheObject()->keys(self::CACHE_KEY_PREFIX.'*');
        foreach ($keys as $v)
        {
            self::getCacheObject()->delete($v);
        }
    }


    /**
     * @param $name     缓存名字  控制器名_方法名
     * @param \Closure $function  数据获取匿名函数变量
     * @return array|mixed
     */
    public static function getCacheData($name,\Closure $function)
    {
        // TODO: Implement __call() method.
        $cacheKey = self::getKey($name);
        $data = self::getCacheObject()->get($cacheKey);

        if(empty($data)){

            $data = $function();
            self::getCacheObject()->setex($cacheKey,self::CACHE_TTL,json_encode($data,true));
            return $data;
        }
        $dataArr = json_decode($data,true);

        if(!is_array($dataArr)){
            return [];
        }
        return $dataArr;
    }


    /**
     * 静态调用
     * @param $name 名字 -> 缓存键
     * @param $arguments -> 实时数据获取函数
     * @return array|''
     */
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __call() method.
        $cacheKey = self::getKey($name);
        $data = self::getCacheObject()->get($cacheKey);

        if(empty($data)){

            $data = $arguments[0]();
            self::getCacheObject()->setex($cacheKey,self::CACHE_TTL,json_encode($data,true));

            return $data;
        }
        $dataArr = json_decode($data,true);

        if(!is_array($dataArr)){
            return [];
        }
        return $dataArr;
    }

}