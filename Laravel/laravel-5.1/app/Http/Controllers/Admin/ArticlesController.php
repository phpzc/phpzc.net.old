<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 16:52
 */

namespace App\Http\Controllers\Admin;

use App\Model\Article;

class ArticlesController extends CommonController
{
    public function getIndex()
    {
        $articles = Article::where('isdel','!=',1)->paginate(10);

        return view('admin.articles.index',['articles'=>$articles]);
    }
}