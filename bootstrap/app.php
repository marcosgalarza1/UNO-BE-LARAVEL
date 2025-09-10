<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \App\Http\Middleware\ForceJsonResponse::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'restrict' => \App\Http\Middleware\RestrictToRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                $error = [
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => 500,
                    ]
                ];

                if ($e instanceof AuthenticationException) {
                    $error['error']['message'] = 'Unauthenticated';
                    $error['error']['code'] = 401;
                } elseif ($e instanceof MethodNotAllowedHttpException) {
                    $error['error']['message'] = 'Method Not Allowed';
                    $error['error']['code'] = 405;
                } elseif ($e instanceof NotFoundHttpException) {
                    $error['error']['message'] = 'Not Found';
                    $error['error']['code'] = 404;
                }

                return response()->json($error, $error['error']['code']);
            }
        });
    })->create();
