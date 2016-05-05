<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 10:08
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function getIndex(Request $request)
    {
        $request->session()->set('id',1);
        if($request->session()->has('id')){
            return view('admin.index.index');
        }else{

            return view('admin.index.login');
        }

    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('id');

        return redirect('/');
    }
}