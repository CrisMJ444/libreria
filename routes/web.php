<?php

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\LibroWebController;
use Illuminate\Support\Facades\Route;

// Login mínimo (solo para la página web; la API vive en routes/api.php y no lo usa)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthWebController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [LibroWebController::class, 'index']);
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');
});
