<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Spatie\LaravelPermission\Src\Middleware\RoleMiddleware as SpatieRoleMiddleware;
use Spatie\LaravelPermission\Src\Middleware\PermissionMiddleware as SpatiePermissionMiddleware;
use Spatie\LaravelPermission\Src\Middleware\RoleOrPermissionMiddleware as SpatieRoleOrPermissionMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            //'is_admin' => \App\Http\Middleware\IsAdmin::class,
         'role' => RoleMiddleware::class,
        'permission' => PermissionMiddleware::class,
        'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
