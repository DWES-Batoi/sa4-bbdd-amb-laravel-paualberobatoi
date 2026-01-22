<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\PartitController;

// Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Protegides (escriptura)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora'])
        ->except(['index', 'show'])
        ->names('api.jugadores');

    Route::apiResource('equips', EquipController::class)
        ->parameters(['equips' => 'equip'])
        ->except(['index', 'show'])
        ->names('api.equips');

    Route::apiResource('partits', PartitController::class)
        ->parameters(['partits' => 'partit'])
        ->except(['index', 'show'])
        ->names('api.partits');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Públiques (lectura)
Route::apiResource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora'])
    ->only(['index', 'show'])
    ->names('api.jugadores');

Route::apiResource('equips', EquipController::class)
    ->parameters(['equips' => 'equip'])
    ->only(['index', 'show'])
    ->names('api.equips');

Route::apiResource('partits', PartitController::class)
    ->parameters(['partits' => 'partit'])
    ->only(['index', 'show'])
    ->names('api.partits');
