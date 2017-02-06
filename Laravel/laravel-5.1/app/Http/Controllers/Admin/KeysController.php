<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/5
 * Time: 下午11:07
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Key;

class KeysController extends AuthController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $keys = Key::paginate(1000);

        return view('admin.keys.index',['keys'=>$keys,'active'=>'keys']);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Key::where('id',$id)->delete();

        if($del){
            return $this->jump('Delete Key Success','/admin/keys/index');
        }else{
            return back();
        }
    }


    public function postCreate(Request $request)
    {
        $data = $request->input();

        if(empty($data['password'])){
            $data['password'] = Key::generatePassword(6,16);
        }
        if($data['id'] != '') {
            $key = Key::find($data['id']);
        }else{
            $key = new Key();
        }
        $key->name = $data['name'];
        $key->username = $data['username'];
        $key->password = $data['password'];
        $key->email = $data['email'];
        $key->url = $data['url'];

        if($data['id'] != ''){
            $key->id = $data['id'];
        }
        if( $key->save()){
            return $this->jump('Create Key Success','/admin/keys/index');
        }else{
            return $this->jump('Create Key Failed','/admin/keys/index');
        }


    }

    public function getEdit(Request $request)
    {
        $id = $request->input('id',0);

        $key = Key::findOrFail($id);

        return view('admin.keys.edit',['key'=>$key,'active'=>'keys']);
    }


}