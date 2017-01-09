<?php
namespace App\Action;
class OtherAction extends CommonAction {
	public function index() {
	}
	
	public function about()
	{
		$info = M('profile')->where('id=1')->find();

		$this->assign('info',$info);

		$msg = M('message')->order('id desc')->limit(10)->select();

		$this->assign('msg',$msg);
		$this->assign('website_title','关于我');
		$this->display();
	}

	public function send_message()
	{
		$number = (int) session('send_message_number');
		$time = (int) session('send_message_time');
		if(!empty($number) && $number > 100 ){
			$this->actionReturn(ACTION_ERROR,' Too fast');
		}
		if($time > 0 && time() - $time  < 60){
			$this->actionReturn(ACTION_ERROR,' One minute one message');
		}
		session('send_message_number',$number + 1);
		session('send_message_time',time());
		$data = I('post.');
		$data['add_time'] = time();
		$model = M('message');

		if(empty($data['email']) or empty($data['name']))
		{
			$this->actionReturn(ACTION_ERROR,'你是傻逼吗');
		}


		$res = $model->add($data);

		if($res){
			$this->actionReturn(ACTION_SUCCESS);
		}else{
			$this->actionReturn(ACTION_ERROR);
		}
	}


	public function projects()
	{
        $this->assign('website_title','开源项目');
		$this->display();
	}
}
?>
