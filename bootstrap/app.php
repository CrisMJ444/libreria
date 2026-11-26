<?php

use App\Http\Traits\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Pequeño helper para reutilizar el formato JSON de errores.
$apiError = fn (string $m, int $s, $e = null) => (new class {
    use ApiResponse;
})::error($m, $s, $e);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // CORS: el middleware HandleCors ya viene activo en Laravel; se configura en config/cors.php
    })
    ->withExceptions(function (Exceptions $exceptions) use ($apiError): void {
        // Siempre JSON en rutas /api/*
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson()
        );

        // 400 Bad Request: validación fallida
        $exceptions->render(function (ValidationException $e, Request $request) use ($apiError) {
            if ($request->is('api/*')) {
                return $apiError('Datos de entrada inválidos', 400, $e->errors());
            }
        });

        // 404 Not Found: ID inexistente (ModelNotFoundException se convierte en NotFoundHttpException) o ruta inexistente
        $exceptions->render(function (NotFoundHttpException $e, Request $request) use ($apiError) {
            if ($request->is('api/*')) {
                return $apiError('Recurso no encontrado', 404);
            }
        });

        // Otros errores HTTP (405 método no permitido, etc.)
        $exceptions->render(function (HttpExceptionInterface $e, Request $request) use ($apiError) {
            if ($request->is('api/*')) {
                return $apiError($e->getMessage() ?: 'Error HTTP', $e->getStatusCode());
            }
        });

        // 500 Internal Server Error: cualquier otra excepción
        $exceptions->render(function (Throwable $e, Request $request) use ($apiError) {
            if ($request->is('api/*')) {
                return $apiError(
                    config('app.debug') ? $e->getMessage() : 'Error interno del servidor',
                    500
                );
            }
        });
    })->create();
