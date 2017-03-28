<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/28
 * Time: 下午5:12
 */

namespace App\Service;


include_once base_path().'/public/aliyun-php-sdk-core/Config.php';
use Sms\Request\V20160927 as Sms;

class SmsService
{
    /**
     * 发送验证码
     * @param $phone
     * @param $code
     *
     * @return bool
     */
    public static function send_code($phone,$code)
    {
        return self::sms_tpl_code($phone,$code);
    }

    /**
     * 发送短信 使用短信模板 SMS_58750038
     * @param $phone
     * @param $code
     *
     * @return bool
     */
    private static function sms_tpl_code($phone,$code)
    {

        $iClientProfile = \DefaultProfile::getProfile('cn-hangzhou', env('ALI_KEY'), env('ALI_SECT'));
        $client = new \DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName(env('ALI_SIGN_NAME'));/*签名名称*/
        $request->setTemplateCode('SMS_58750038');/*模板code*/
        $request->setRecNum($phone);/*目标手机号*/
        $request->setParamString("{\"code\":\"{$code}\"}");/*模板变量，数字一定要转换为字符串*/
        try {
            $response = $client->getAcsResponse($request);

            return true;
        }
        catch (\ClientException  $e) {
            return false;
        }
        catch (\ServerException  $e) {
            return false;
        }
    }
}