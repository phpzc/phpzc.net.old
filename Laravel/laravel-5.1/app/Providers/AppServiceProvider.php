<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * 启动任何应用的服务
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //共享视图数据
        view()->share('SITE_URL','SITE_URL');
        view()->share('SITE_NAME','SITE_NAME');

        //for menu active class
        view()->share('MENU_ELEMENT',false);
        view()->share('active','');



        //添加DB sql查询监控
        /*
        DB::listen(function($sql, $bindings, $time){
            $f = fopen('sql.txt','a+');
            fwrite($f,$sql);
            fclose($f);
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //file_put_contents('testapp.txt','test');
    }
}
