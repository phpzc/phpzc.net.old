<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/5/5
 * Time: 10:08
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;

class IndexController extends CommonController
{

    /**
     *
     * 内存
     * 磁盘空间
     *
     *
     * @return array
     */
    public function get_used_status(){


        $system_data = [];

        $system_data['memory'] = '';
        $system_data['memory_max'] = '';
        $system_data['memory_used'] = '';


        if( strstr(PHP_OS, 'WIN')){
            //win

            return $system_data;
        }

        exec('uname',$return,$result);
        if($result != 0){
            return $system_data;
        }

        $env = $return[0];


        if($env === 'Darwin')
        {
            //mac
            $cpuStr = exec('top -l 1 | head -n 10 | grep PhysMem');

            preg_match('/PhysMem: (.*?)M used \((.*?)M wired\), (.*?)M unused./',$cpuStr,$c2);

            $system_data['memory'] = $c2[1] * 1.0 / ($c2[1] + $c2[3]) * 100;
            $system_data['memory_max'] = ($c2[1] + $c2[3]).'m';
            $system_data['memory_used'] = $c2[1].'m';


        }else if($env == 'Linux'){
            //linux

            $system_data['memory'] = '';
            $system_data['memory_max'] = '';
            $system_data['memory_used'] = '';

        }

        return $system_data;
    }


    public function getIndex(Request $request)
    {
        if($request->session()->has('id') ){
            $id = $request->session()->get('id');
            if($id == 1){

                $system = $this->get_used_status();

                //data
                $data = DB::table('visit')->where('day','like',date('Ym').'%')
                    ->select('day', DB::raw('count(id) as total_visit'))
                ->groupBy('day')
                ->get();

                $ip_count = array_map(function($v){
                    return $v->total_visit;
                },$data);

                $day_data = array_map(function($v){
                    return date('m-d',strtotime($v->day));
                },$data);

                //年 月 日 访问数
                $data1 = DB::table('visit')->where('day','like',date('Y').'%')
                    ->select( DB::raw('sum(id) as total_visit'))
                    ->get();
                $data2 = DB::table('visit')->where('day','like',date('Ym').'%')
                    ->select( DB::raw('sum(id) as total_visit'))
                    ->get();
                $data3 = DB::table('visit')->where('day',date('Ymd'))
                    ->select( DB::raw('sum(id) as total_visit'))
                    ->get();



                return view('admin.index.index',['ip_count'=>json_encode($ip_count,true),'day_data'=>json_encode($day_data,true),
                    'year'=>$data1[0]->total_visit,
                    'month'=>$data2[0]->total_visit,
                    'day'=>$data3[0]->total_visit,
                    'system'=>$system,
                    'users'=>DB::table('user')->count(),
                    'articles'=>DB::table('article')->where('isdel',0)->count(),
                    'documents'=>DB::table('document')->count(),
                ]);
            }
        }

        return view('admin.index.login',['username'=>$request->cookie('username'),'password'=>$request->cookie('password')]);

    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('id');

        return redirect('/');
    }

    public function postCheck(Request $request)
    {
        $res = DB::table('user')->where('id',1)->first();
        $pwd = $request->input('password','');

        if($res->password == md5($pwd)){
            $request->session()->put('id',1);
            $request->session()->put('name',$res->name);

            $response = new Response();
            $response->withCookie(cookie()->forever('username', $request->input('username','')));
            $response->withCookie(cookie()->forever('password', $request->input('password','')));
            $response->setContent('<script>location.href="/"</script>');

            return $response;
        }else{
            return redirect('/');
        }
    }
}