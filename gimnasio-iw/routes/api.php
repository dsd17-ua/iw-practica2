<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SesionController;
use App\Http\Middleware\CheckApiKey;
use App\Http\Controllers\Api\SocioController;
use App\Http\Controllers\Api\SalaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// AÑADE ESTO:
Route::get('/planes', [PlanController::class, 'index']);
Route::get('/sesiones', [SesionController::class, 'index']);

// GRUPO DE RUTAS SECURIZADAS
Route::middleware([CheckApiKey::class])->group(function () {
    
    // 4.3 Validar Socio (POST)
    Route::post('/socios/validar', [SocioController::class, 'validar']);

    // 4.4 Aforo Sala (GET)
    Route::get('/salas/{id}/aforo', [SalaController::class, 'aforo']);
});