<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/20
 * Time: 下午10:11
 */

namespace App\Http\Controllers\Admin;
use App\Model\Article;
use App\Model\Photo;
use App\Model\Document;
use DB;
class ChartsController extends AuthController
{
    public function getIndex()
    {
        $year = date('Y');
        //计算本年度 各个分类下的 项目数量 统计
        $article_data = Article::select('month',DB::raw('COUNT(id) as num'))->groupBy('month')
            ->where('year',$year)
            ->get();

        $photo_data = Photo::select('month',DB::raw('COUNT(id) as num'))->groupBy('month')
        ->where('year',$year)
        ->get();

        $document_data = Document::select('month',DB::raw('COUNT(id) as num'))->groupBy('month')
            ->where('year',$year)
            ->get();

        $month = (int)date('m');

        for($i=0;$i<$month;$i++)
        {
            if(empty($article_data[$i]))
            {
                $article_data[$i] = ['month'=>$i+1,'num'=>0];
            }
            if(empty($photo_data[$i]))
            {
                $photo_data[$i] = ['month'=>$i+1,'num'=>0];
            }
            if(empty($document_data[$i]))
            {
                $document_data[$i] = ['month'=>$i+1,'num'=>0];
            }

        }
        $newData = [];
        foreach($article_data as $k=>$v)
        {
            $newData[] = [
                'period'=>$year.'-'.$v['month'],
                'article'=>$v['num'],
                'photo'=>$photo_data[$k]['num'],
                'document'=>$document_data[$k]['num'],
            ];
        }


        return view('admin.charts.index', [
                'data'=>$newData,
                'active'=>'charts',
            ]);
    }
}