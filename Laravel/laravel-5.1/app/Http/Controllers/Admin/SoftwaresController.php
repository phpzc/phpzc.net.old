<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/5
 * Time: 下午11:07
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Software;
class SoftwaresController extends CommonController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $softwares = Software::where('isdel','!=',1)->paginate(10);
        //dump($softwares);
        return view('admin.softwares.index',['softwares'=>$softwares]);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Software::where('id',$id)->update(
            array('isdel'=>1)
        );

        if($del){
            return redirect('/admin/softwares/index');
        }else{
            return back();
        }
    }
}