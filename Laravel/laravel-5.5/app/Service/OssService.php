<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2018/8/11
 * Time: 下午8:58
 */

namespace App\Service;

define('OSS_BUCKET',env('OSS_BUCKET', ''));
define('OSS_ACCESS_ID',env('OSS_ACCESS_ID', ''));
define('OSS_ACCESS_KEY',env('OSS_ACCESS_KEY', ''));
define('OSS_ENDPOINT',env('OSS_ENDPOINT', ''));


class OssService extends Service
{
    const endpoint = OSS_ENDPOINT;
    const accessKeyId = OSS_ACCESS_ID;
    const accessKeySecret = OSS_ACCESS_KEY;
    const bucket = OSS_BUCKET;

    /**
     * 根据Config配置，得到一个OssClient实例
     *
     * 一个OssClient实例
     *
     * @return \OSS\OssClient
     */
    public static function getOssClient()
    {
        try {
            $ossClient = new \OSS\OssClient(self::accessKeyId, self::accessKeySecret, self::endpoint, false);
        } catch (\Oss\Core\OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }

    public static function getBucketName()
    {
        return self::bucket;
    }


}