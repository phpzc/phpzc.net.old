<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 16:52
 */

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;

class ArticlesController extends AuthController
{
    public function getIndex()
    {
        view()->share('MENU_ELEMENT',true);
        $articles = Article::where('isdel','!=',1)->paginate(10);

        return view('admin.articles.index',['articles'=>$articles]);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id',0);

        $del = Article::where('id',$id)->update(
            array('isdel'=>1)
        );

        if($del){
            return redirect('/admin/articles/index');
        }else{
            return back();
        }
    }
}