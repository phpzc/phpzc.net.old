<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/15
 * Time: 14:44
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use DB;
use App\Users;
use App\Model\Record;

use App\Service\RecordService;

class IndexController extends Controller
{
    protected function dump($str)
    {
        echo "<pre>";

        var_dump($str);
        echo "</pre>";
    }
    public function index()
    {
//        $f = route('testroute');
//        echo $f;

//        echo "<br>";
//        echo Crypt::encrypt('123213');
//        echo "<br>";
//        $res = DB::select('select * from la_user where id = ?',[1]);
//
//        dump($res);



//        DB::transaction(function(){
//            DB::table('user')->where('id',1)->delete();
//
//            throw new \Exception('error delete');
//        });

//        DB::table('user')->chunk(3,function($users){
//
//            foreach($users as $user){
//                echo $user->name;
//                echo "<br/>";
//            }
//
//            return false;
//        });

        $res2 = DB::table('user')
            ->where('id','!=',2)
            ->get();

        dump($res2);

        $res3 =DB::table('user')->select(DB::raw('count(*) as num'))
            ->first();

        dump($res3);


//        DB::table('user')->insert([
//            ['name'=>strval(rand()),'pwd'=>strval(rand())],
//            ['name'=>strval(rand()),'pwd'=>strval(rand())],
//            ['name'=>strval(rand()),'pwd'=>strval(rand())]
//
//        ]);


        //dump(Users::take(3)->get());

        //dump(Users::active(19)->first()->name);

        //DB::table('user')->truncate();
        //Users::where('id',1)->delete();

        //$users = Users::active(19)->get();

//        $name = $users->reject(function($user){
//            return $user->id > 22;
//        })->map(function($user){
//            return $user->id;
//        });
//
//        dump($name);
//
//
//        $record = new Record();
//        $record->title = md5(rand());
//        $record->face_img = md5(uniqid());
//        $record->save();
//
//        //Users::where('id','>',20000)->findOrFail();
//
//        dump(Record::where('id',2)->delete());
//        $obj = new RecordService();
//        dump($obj->delete(1,true));
//        $recordNow = Record::where('id','>',1)->get();
//
//
//        dump($recordNow);
    }
}