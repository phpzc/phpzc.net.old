<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/5
 * Time: 下午11:07
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Album;
class AlbumsController extends AuthController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $albums = Album::where('isdel','!=',1)->paginate(10);

        return view('admin.albums.index',['albums'=>$albums,'active'=>'albums']);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Album::where('id',$id)->update(
            array('isdel'=>1)
        );

        if($del){
            return redirect('/admin/albums/index');
        }else{
            return back();
        }
    }
}