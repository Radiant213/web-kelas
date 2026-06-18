<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// Jangan lupa import class middleware lu di atas sini
use App\Http\Middleware\CheckProfileCompletion;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // --- TAMBAHIN INI BANG ---
        $middleware->alias([
            'profile.check' => CheckProfileCompletion::class,
        ]);
        // -------------------------
    
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();