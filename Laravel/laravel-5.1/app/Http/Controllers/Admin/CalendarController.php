<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/20
 * Time: 15:49
 */

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;

class CalendarController extends AuthController
{
    public function getIndex()
    {
        return view('admin.calendar.index');
    }
}