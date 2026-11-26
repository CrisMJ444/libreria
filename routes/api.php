<?php

use App\Http\Controllers\Api\V1\LibroController;
use Illuminate\Support\Facades\Route;

// Laravel agrega el prefijo "/api" a este archivo; aquí se añade "v1".
// Resultado: /api/v1/libros, /api/v1/libros/{id}
Route::prefix('v1')->group(function () {
    Route::apiResource('libros', LibroController::class)
        ->parameters(['libros' => 'id'])
        ->where(['id' => '[0-9]+']);
});
