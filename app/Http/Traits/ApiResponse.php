<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Formato JSON estandarizado para todas las respuestas:
 * { "success": bool, "message": string, "data": mixed|null, "errors": object (solo en errores) }
 */
trait ApiResponse
{
    protected function ok(mixed $data = null, string $message = 'OK', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function created(mixed $data, string $message = 'Recurso creado'): JsonResponse
    {
        return $this->ok($data, $message, 201);
    }

    public static function error(string $message, int $status, mixed $errors = null): JsonResponse
    {
        $body = ['success' => false, 'message' => $message, 'data' => null];
        if ($errors !== null) {
            $body['errors'] = $errors;
        }

        return response()->json($body, $status);
    }
}
