<?php

namespace App\Http;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\CheckForMaintenanceMode::class,
        ],

        'api' => [
            'throttle:api',
            'bindings',
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\HomeController::class,
        'checkAuth' => \App\Http\Middleware\CheckAuth::class, // This line registers the middleware
    ];
}

