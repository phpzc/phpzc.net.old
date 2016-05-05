<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    //
    protected $table = 'record';
    //维护 created_at updated_at
    public $timestamps = true;
    //软删除
    use SoftDeletes;

}
