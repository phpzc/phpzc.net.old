<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/5
 * Time: 下午11:07
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Photo;
class PhotosController extends AuthController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $photos = Photo::where('isdel','!=',1)->paginate(10000);

        return view('admin.photos.index',['photos'=>$photos,'active'=>'photos']);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Photo::where('id',$id)->update(
            array('isdel'=>1)
        );

        if($del){
            return $this->jump('Delete Photos Success','/admin/photos/index');
        }else{
            return back();
        }
    }
}