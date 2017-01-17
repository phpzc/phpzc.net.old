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
use App\Model\Link;

class LinksController extends CommonController
{

    public function getIndex(Request $request)
    {

        $res = DB::table('links')->orderBy('id', 'desc')->paginate(10000);;

        return view('admin.links.index',['links'=>$res,'active'=>'links']);

    }

    public function getDel(Request $request)
    {
        $id =  $request->input('id');

        $res = Link::where('id',$id)->delete();
        if(empty($res)){
            return $this->jump('delete error','/admin/links/index');
        }else{
            return $this->jump('delete success','/admin/links/index');
        }



    }



    public function getActive(Request $request)
    {
        $id =  $request->input('id');

        $res = Link::where('id',$id)->first();
        if(empty($res)){
            return $this->jump('no link data','/admin/links/index');
        }

        if($res->status == 0){
            $res->status = 1;
        }else{
            $res->status = 0;
        }

        $save = $res->save();

        if($save){
            return $this->jump('update success','/admin/links/index');
        }else{
            return $this->jump('update error','/admin/links/index');
        }
    }

}