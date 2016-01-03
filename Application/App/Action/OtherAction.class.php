<?php
namespace App\Action;
class OtherAction extends CommonAction {
	public function index() {
	}
	
	public function about()
	{
		$info = M('profile')->where('id=1')->find();

		$this->assign('info',$info);
		
		$this->display();
	}
}
?>
