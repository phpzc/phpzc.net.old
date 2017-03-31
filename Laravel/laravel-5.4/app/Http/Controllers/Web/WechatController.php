<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/31
 * Time: 上午9:55
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Log;
class WechatController extends Controller
{
    public final function index()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 ！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}