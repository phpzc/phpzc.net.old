<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/17
 * Time: 下午4:53
 */

namespace App\Http\Controllers\Web;

use App\Model\Key;
use App\Model\Keyword;
use App\Model\Category;

use Illuminate\Support\Facades\DB;

class KeywordController
{
    /*
     * 处理标签方法
     * @param $insertId 插入id
     * @param $data tag数据
     * @param $tableName
     * 要对哪个表做关键字
     */
    public function automake($insertId, $data, $tableName) {

        $table = $tableName.'keyword';
        $arr ['realid'] = $insertId;

        $x = null;
        $add = null;

        if (! empty ( $data )) {
            $data = str_replace ( '，', ",", $data );
            $dataArr = explode ( ',', trim ( $data, ',' ) );

            $i = 0;
            foreach ( $dataArr as $v ) {
                // 取得标签id
                if (

                    $x = Keyword::where(['name'=>$v])->first()
                ) {
                    $x = $x->toArray();
                    $arr ['kid'] = $x ['id'];
                } else {

                    $add = Keyword::insertGetId(['name'=>$v]);

                    $arr ['kid'] = $add;
                }

                DB::table($table)->insert($arr);
                $i ++;
                if ($i == 5)
                    break;
            }
        }
    }


    /*
     * 更新标签
     * @param $tableName
     * @param $realid
     * @param $str	关键字字符串
     * @return
     */
    public function updateCategory($tableName, $realid, $tagstr) {
        // 先删除旧的 再添加新的
        $name =   strtolower ( $tableName )  . 'keyword';
        DB::table($name)->where(['realid'=>$realid])->delete();

        $this->automake ( $realid, $tagstr, $tableName );
    }



    /*
     * 取得当前文章的关键字 @param $tableName @param $realid @return $str
     */
    public function getCategoryString($tableName, $realid) {
        $name = strtolower ( $tableName ) . 'keyword';


        $table = DB::table($name);

        // 找出keyword id
        $kres = $table->where ( array (
            "realid" => $realid
        ) )->get();
        if ($kres->isEmpty()) {
            return '';
        } elseif (count ( $kres->all() ) == 1) {

            //$where = 'id = ' . $kres [0] ['kid'];

            $where = ['id'=> ((($kres->toArray())[0])->toArray())['kid']];

            $conn = Keyword::where($where);
        } else {
            $where = 'id in (';
            foreach ( $kres as $v ) {
                $where .= $v ['kid'] . ',';
            }
            $where = trim ( $where, ',' ) . ')';

            $data = $kres->toArray();
            $whereId = [];
            foreach ($data as $v){
                $whereId[] = $v['kid'];
            }

            $conn = Keyword::where('id','in',$whereId);
        }


        $res = $conn->get();

        if ($res) {
            $str = '';
            $res = $res->toArray();
            foreach ( $res as $v ) {
                $str .= $v ['name'] . ',';
            }

            return trim ( $str, ',' );
        }
        return '';
    }
}