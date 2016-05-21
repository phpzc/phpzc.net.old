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
        /*
        $start = strtotime(date('Y-m-01'));
        $end = strtotime(date('Y-m-t'));


        $result = Article::whereBetween('time',[$start,$end])->get();

        $newArray = [];
        foreach ($result as $v){
            $v = $v->toArray();
            $v['day'] = (int)date('d',$v['time']);
            $v['month'] = (int)$v['month'];
            $v['url'] = 'http://'.$_SERVER['HTTP_HOST'];
            $newArray[] = $v;

        }


        return view('admin.calendar.index',['data'=>$newArray]);
        */

        return view('admin.calendar.index',['active'=>'calendars']);
   }

}