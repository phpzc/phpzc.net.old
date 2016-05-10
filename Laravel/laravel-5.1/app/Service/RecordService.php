<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2016/4/28
 * Time: 16:21
 */

namespace App\Service;

use App\model\Record;
use DB;

class RecordService extends Service
{
    /**
     * @var \App\model\Record
     */
    protected $db;

    public function _init()
    {
        $this->db = new Record();
    }

    public function delete( $id,$real = false)
    {
        if($real){
            return DB::table($this->db->getTable())->where('id',1)->delete();
        }else{
            return Record::where('id',$id)->delete();
        }
    }
}