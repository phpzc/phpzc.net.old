<?php
namespace App\Service;

use App\Model\User;

class UserService extends Service {


    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getById( $id)
    {
        $user = User::where('id',$id)->first();

        return $user;
    }

    /**
     * @param string $username
     *
     * @return mixed
     */
    public function getByName( $username)
    {

        $user = User::where('username',$username)->first();

        return $user;
    }


    public function createUser( $username, $password)
    {

    }


    /**
     * @param string $username
     * @param string $password
     *
     * @return bool|mixed
     */
    public function login( $username, $password)
    {
        $user = $this->getByName($username);

        if( !$user)
        {
            session(['error'=> __('msg.login_error')]);
            return false;
        }else{

            if($user->password != $this->change_password($password))
            {
                session(['error'=>__('msg.login_error')]);
                return false;
            }

            session(['name'=>$user->name]);
            session(['id'=>$user->id]);
            session(['username'=>$user->username]);

            return true;
        }
    }


    /**
     * @param string $password
     *
     * @return string
     */
    protected function change_password( $password)
    {
        return md5($password);
    }

}