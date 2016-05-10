<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    //
    protected $table = 'user';

    protected $primaryKey = 'id';

    //不维护 created_at updated_at
    public $timestamps = false;
    // created_at updated_at foramt
    protected $dateFormat = 'U';

    //connect name
    //protected $connection = 'default';

    //可被赋值字段
    protected $fillable=['name','pwd'];


    //自动转换数据类型
    protected $casts = [
        //'is_admin' => 'boolean',
        //'text' => 'array',
    ];

    //软删除功能 定义deleted_at 可以 与 created_at updated_at 配合一起 所有表都用  查找时 软删除 会被剔除
    use SoftDeletes;

    /**
     * @param $query
     * @param $num
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query,$num)
    {

        return $query->where('id','>',$num);
    }
}
