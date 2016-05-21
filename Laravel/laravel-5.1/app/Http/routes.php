<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

if(defined('ROUTE_MODE_ENV') &&  ROUTE_MODE_ENV== 2){
    Route::get('/', function () {
        return view('welcome');
    });
}else{
    Route::get('/','Admin\IndexController@getIndex');
}


//命名路由 可使用名称 生产URL
Route::any('/test/any','IndexController@index')->name('testroute');

//命名空间下的 路由
//后台
Route::group(['namespace'=>'Admin','prefix'=>'admin/'],function(){

    Route::controller('index', 'IndexController');
    Route::controller('articles', 'ArticlesController');
    Route::controller('albums','AlbumsController');
    Route::controller('photos','PhotosController');
    Route::controller('softwares','SoftwaresController');
    Route::controller('carousel','CarouselController');
    Route::controller('calendar','CalendarController');
    Route::controller('charts','ChartsController');
});

//前台
Route::group(['namespace'=>'Front','prefix'=>'front/'],function(){

    Route::any('/',function(){
        return redirect()->route('testroute');
    });
    Route::any('/index',function(){
        return redirect('front/index/uselayout');
    });

    Route::any('/index/redirect',function(){
        //跳转 设置session
        return redirect('front/index/uselayout')->with('status','flash session success');
    });

    Route::any('/index/index','IndexController@index');// match /front/index/index

    Route::any('/about',function(){
       return view('Front.Index.about');
    });

    Route::any('/index/uselayout','IndexController@uselayout');

    //附加路由 在资源路由前定义 photo 在调用resource photo之前
    Route::get('photo/extra','PhotoController@extra');

    Route::resource('photo','PhotoController',['only'=>['show','index']]);//只路由指定的


    Route::controller('simple', 'SimpleController');
    Route::get('simple/param/{id}','SimpleController@getParam');

});
