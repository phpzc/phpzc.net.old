<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/9
 * Time: 上午10:43
 */

namespace App\Http\Controllers\Web;


use App\Model\Category;
use App\Model\Keyword;
use App\Model\Project;
use App\Model\ProjectSummary;
use App\Model\Article;

use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{

    public final function index()
    {

        return 'index';
    }
}