<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/8/22
 * Time: 上午12:07
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Model\Profile;

class ProfileController extends AuthController
{
    public function getIndex()
    {
        $user = Profile::find(1);

        return view('admin.profile.index',['user'=>$user,'active'=>'profile']);
    }

    public function postIndex(Request $request)
    {
        $user = Profile::find(1);

        $all = $request->input();

        $all['description'] = htmlspecialchars($all['description']);

        foreach ($all as $k=>$v){
            $user->$k = $v;

            if($k == 'begin_time'){
                $user->$k = strtotime($v);
            }
        }

        if($user->save()){
            return $this->jump('update success','/admin/profile/index');
        }else{
            return $this->jump('update error','/admin/profile/index');
        }
    }

}