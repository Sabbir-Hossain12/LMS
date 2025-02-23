<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
          'admin' => App\Http\Middleware\AdminMiddleware::class,
          'teacher' => App\Http\Middleware\TeacherMiddleware::class,
          'student' => App\Http\Middleware\StudentMiddleware::class, 
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'checkAuth' => \App\Http\Middleware\AuthMiddleware::class
        ]);

        $middleware->validateCsrfTokens(except: [
            '/bkash/payment',
            '/bkash/create-payment',
            '/bkash/callback', 
            '/bkash/search/{trxID}',
            '/bkash/refund', 
            '/bkash/refund/status'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();
