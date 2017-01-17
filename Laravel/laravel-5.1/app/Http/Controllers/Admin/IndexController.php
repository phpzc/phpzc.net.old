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
use Illuminate\Http\Response;

class IndexController extends CommonController
{
    public function getIndex(Request $request)
    {
        if($request->session()->has('id') ){
            $id = $request->session()->get('id');
            if($id == 1)
                return view('admin.index.index');
        }

        return view('admin.index.login',['username'=>$request->cookie('username'),'password'=>$request->cookie('password')]);

    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('id');

        return redirect('/');
    }

    public function postCheck(Request $request)
    {
        $res = DB::table('user')->where('id',1)->first();
        $pwd = $request->input('password','');

        if($res->password == md5($pwd)){
            $request->session()->put('id',1);
            $request->session()->put('name',$res->name);

            $response = new Response();
            $response->withCookie(cookie()->forever('username', $request->input('username','')));
            $response->withCookie(cookie()->forever('password', $request->input('password','')));
            $response->setContent('<script>location.href="/"</script>');

            return $response;
        }else{
            return redirect('/');
        }
    }
}