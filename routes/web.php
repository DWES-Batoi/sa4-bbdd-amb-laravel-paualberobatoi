<?php

use App\Http\Controllers\JugadoraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\PartitController;

Route::get('/', function () {
    return redirect()->route('estadis.index');
});

Route::resource('/estadis', EstadiController::class);
Route::resource('/equips', EquipController::class);
Route::resource('/jugadoras', JugadoraController::class);
Route::resource('/partits', PartitController::class);