<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;

// Página principal: redirige a la lista de equipos o muestra la bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard de Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ RUTAS PÚBLICAS: Todo el mundo puede ver las listas (index)
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);
Route::resource('jugadoras', JugadoraController::class)->only(['index']);
Route::resource('partits', PartitController::class)->only(['index']);


// 🔒 RUTAS PROTEGIDAS: Solo usuarios logueados pueden crear, editar o borrar
Route::middleware('auth')->group(function () {
    
    // Rutas de Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de gestión (Create, Store, Edit, Update, Destroy)
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::resource('jugadoras', JugadoraController::class)->except(['index', 'show']);
    Route::resource('partits', PartitController::class)->except(['index', 'show']);
});


// ✅ RUTAS PÚBLICAS: El detalle (show) se pone al final para no entrar en conflicto con /create
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);
Route::resource('jugadoras', JugadoraController::class)->only(['show']);
Route::resource('partits', PartitController::class)->only(['show']);

require __DIR__.'/auth.php';