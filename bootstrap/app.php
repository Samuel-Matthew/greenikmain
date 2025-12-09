<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthRedirect;
use App\Http\Middleware\GuestRedirect;
use App\Http\Middleware\IsAdmin;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {


        $middleware->alias([
            'IsAdmin' => IsAdmin::class,
        ]);
        //
        // Add middleware to the web group (applied to all web routes)
        // $middleware->appendToGroup('web', [
        //     AuthRedirect::class,   // protects authenticated routes
        //     GuestRedirect::class,  // protects guest-only routes
        // ]);

        // // Define aliases for route-level use
        // $middleware->alias('auth', AuthRedirect::class);       // use ->middleware('auth')
        // $middleware->alias('guest', GuestRedirect::class);    // use ->middleware('guest')
        // $middleware->alias('is_admin', IsAdmin::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
