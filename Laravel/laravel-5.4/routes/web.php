<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 自动注册方法到路由  替代5.1 controller
 *              利用php反射机制 加用户自定义方法 final标识
 *
 *
 * @param string $controllerName 控制器无后缀名称
 * @param string $namespace 项目空间名称
 *
 * @author zhangcheng
 */
function setRouteMap($controllerName,$namespace = 'Web')
{
    $controllerName = strtolower($controllerName);
    $ucControllerName = ucfirst($controllerName).'Controller';
    $namespace = ucfirst(strtolower($namespace));

    $name = '\\App\\Http\\Controllers\\'.$namespace.'\\'.$ucControllerName;

    $reflection = new \ReflectionClass($name);

    foreach($reflection->getMethods() as $k=>$v)
    {
        // condition
        if($v->class != 'Illuminate\Routing\Controller' && $v->isPublic() && $v->isFinal() )
        {
            //add route
            Route::any('/'.$controllerName.'/'.$v->name,$ucControllerName.'@'.$v->name);
        }

    }

}

Route::get('/','Web\IndexController@index');

Route::group(['namespace'=>'Web'],function(){

    //定义web项目路由
    setRouteMap('user');
    setRouteMap('index');

});


