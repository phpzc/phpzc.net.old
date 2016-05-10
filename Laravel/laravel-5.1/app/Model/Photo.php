<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 16/5/5
 * Time: 下午11:08
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';

    public $timestamps = false;
}