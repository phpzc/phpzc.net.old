<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 10:08
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
class IndexController extends CommonController
{
    public function getIndex(Request $request)
    {
        //$request->session()->set('id',1);
        if($request->session()->has('id') ){
            $id = $request->session()->get('id');
            if($id == 1)
                return view('admin.index.index');
        }

        return view('admin.index.login');

    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('id');

        return redirect('/');
    }

    public function getCheck(Request $request)
    {
        $res = DB::table('user')->where('id',1)->first();
        $pwd = $request->input('password','');

        if($res->password == md5($pwd)){
            $request->session()->put('id',1);
            echo 1;
        }
    }
}