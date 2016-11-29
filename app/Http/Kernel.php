<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        'verify_if_user_is_super_admin' => \App\Http\Middleware\VerifyIfUserIsSuperAdmin::class,
        'verify_if_user_is_admin'       => \App\Http\Middleware\VerifyIfUserIsAdmin::class,
        'verify_if_user_is_collection'  => \App\Http\Middleware\VerifyIfUserIsCollection::class,
        'verify_if_user_is_sales_engineer' => \App\Http\Middleware\VerifyIfUserIsSalesEngineer::class,
        'verify_if_user_is_assistant'   => \App\Http\Middleware\VerifyIfUserIsAssistant::class,
        'verify_if_user_is_secretary'   => \App\Http\Middleware\VerifyIfUserIsSecretary::class
    ];
}
