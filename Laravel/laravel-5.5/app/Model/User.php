<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 主键名称
     * @var string
     */
    public $primaryKey = 'id';


    public $table = 'user';

    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    //protected $connection = '';



}