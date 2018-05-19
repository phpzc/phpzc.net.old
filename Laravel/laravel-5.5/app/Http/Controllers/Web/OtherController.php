<?php
namespace App\Http\Controllers\Web;

use App\Model\Profile;
use App\Model\Message;

use App\Service\SmsService;

class OtherController extends CommonController
{
    public final function about()
    {
        $profile = Profile::where(['id'=>1])
        ->first()->toArray();

        $this->assign('info',$profile);


        $msg = Message::orderBy('id','desc')
            ->limit(10)->get()->toArray();
        $this->assign('msg',$msg);
        $this->assign('website_title','关于我');

        return view('other.about');
    }

    public final function send_message()
    {
        $number = (int) session('send_message_number');
        $time = (int) session('send_message_time');
        if(!empty($number) && $number > 100 ){
            $this->actionReturn(ACTION_ERROR,' Too fast');
        }
        if($time > 0 && time() - $time  < 60){
            $this->actionReturn(ACTION_ERROR,' One minute one message');
        }
        session(['send_message_number'=>$number + 1]);
        session(['send_message_time'=>time()]);
        $data = $_POST;
        $data['add_time'] = time();
        $model = M('message');

        if(empty($data['email']) or empty($data['name']))
        {
            $this->actionReturn(ACTION_ERROR,'你是傻逼吗');
        }


        $res = Message::insertGetId($data);

        if($res){
            $this->actionReturn(ACTION_SUCCESS);
        }else{
            $this->actionReturn(ACTION_ERROR);
        }
    }


    public final function projects()
    {
        $this->assign('website_title','开源项目');
        return view('other.projects');
    }

    public final function test()
    {
        SmsService::run(18013460339,1234);
    }
}