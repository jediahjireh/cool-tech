<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// add middleware
use App\Http\Middleware\EnsureWriterPasswordIsValid;
use App\Http\Middleware\EnsureAdminPasswordIsValid;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    // manage the middleware assigned to application's routes
    ->withMiddleware(function (Middleware $middleware) {
        // add the middleware to the end of the list of global middleware
        $middleware->append(EnsureWriterPasswordIsValid::class);
        $middleware->append(EnsureAdminPasswordIsValid::class);

        $middleware->alias([
            'writer' => EnsureWriterPasswordIsValid::class,
            'admin' => EnsureAdminPasswordIsValid::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
