<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/7/28
 * Time: 下午11:00
 */
namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use DB;
class LinksController extends CommonController
{

    public function getIndex(Request $request)
    {

        $res = DB::table('links')->paginate(10);;

        return view('admin.links.index',['links'=>$res]);

    }

    public function getDel()
    {

    }

    public function getEdit(Request $request)
    {
        $id = $request->input('id',0);
        $res = DB::table('links')->where('id',$id)->first();

        if(empty($res)){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function postEdit()
    {

    }

}