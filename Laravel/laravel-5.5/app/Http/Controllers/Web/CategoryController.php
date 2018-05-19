<?php
/**
 * Created by PhpStorm.
 * User: zhangcheng
 * Date: 2017/3/17
 * Time: 下午5:36
 */

namespace App\Http\Controllers\Web;

use App\Model\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends CommonController
{

    public function _initialize() {
        parent::_initialize ();

        if (session('id') != 1) {
            abort(404);
        }
    }

    public final function index() {

        $result = DB::select("select *, concat(path,'-',id) as bpath from vip_category order by bpath,id desc");

        $this->assign ( 'result', $result );

        return view('category.index');
    }

    public final function add() {

        $data = array ();

        foreach ( $_POST as $k => $v ) {

            if ($k == 'top') {
                foreach ( $v as $x ) {
                    if (empty ( $x ))
                        continue;
                    $data ['name'] = $x;
                    $data ['pid'] = 0;
                    $data ['path'] = 0;

                    Category::insert($data);
                }
            } else {
                $id = explode ( 'd', $k );
                $id = $id [1];

                $path = Category::where(['id'=>$id])->first()->toArray();

                $path = $path ['path'];
                $path = $path . '-' . $id;
                foreach ( $v as $x ) {
                    if (empty ( $x ))
                        continue;
                    $data ['name'] = $x;
                    $data ['pid'] = $id;
                    $data ['path'] = $path;

                    Category::insert($data);
                }
            }
        }

        request()->session()->forget('select_category');

        $this->formSuccess( '添加成功','category/index' );
    }
    public final function edit() {
        $name = request()->input('data');

        $id = request()->input('id');

        $update = Category::where(['id'=>$id])
            ->update(['name'=>$name]);
        if ($update) {
            request()->session()->forget('select_category');
            $this->formSuccess( '修改成功','category/index' );
        } else {
            $this->formErrorReferer( '修改失败','category/index' );

        }
    }
    public final function del() {
        $id = request()->input('id');;


        try {

            $r = Category::where(['id'=>$id])->first();
            $r = $r->toArray();

            Category::where ('path','like', $r['path'] . '-' . $id . '%' )->delete();
            // 删除旗下所有的类
            Category::where (['id'=>$id])->delete ();
            request()->session()->forget('select_category');
            $this->formSuccess( '删除成功','category/index' );

        } catch ( Exception $e ) {
            echo $e->getMessage ();
        }
    }
}