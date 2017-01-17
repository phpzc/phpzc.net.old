<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *  全局使用的中间件列表
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //\App\Http\Middleware\VerifyCsrfToken::class,//不使用csrf
        //\App\Http\Middleware\TestMiddleware::class, //定义到这里就会运行到

    ];

    /**
     * The application's route middleware.
     * 设置中间件名称对应类   可手动加载中间件类 到自定义类中
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'test' => \App\Http\Middleware\TestMiddleware::class,
        'AdminAuth' => \App\Http\Middleware\AdminAuthMiddleware::class,
    ];
}
