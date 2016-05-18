<?php
use Phalcon\Mvc\View;
class SignController extends ControllerBase
{

    public function indexAction()
    {

        if($this->request->isPost()){
            $user = new User();
            $user->username = '123123';
            //$user->name='213123123';
            $user->password ='213';
            $user->regip=123;
            $user->regtime=213213;


            var_dump($user->save());

            foreach ($user->getMessages() as $message)
            {
                echo $message;
            }

//        var_dump($this->request->getPost());
//        var_dump($this->request->get());
            //$this->view->disable();

            $this->flashSession->error('error aaasdas');
            return $this->dispatcher->forward(array('action'=>'login'));
        }else{

        }

    }

    public function loginAction()
    {
        $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
    }

}

