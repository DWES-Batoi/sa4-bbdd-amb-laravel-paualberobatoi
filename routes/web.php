<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController; 
use App\Http\Controllers\PartitController;   
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;      // 👈 Necessari per a l'idioma

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- ✅ RUTA PER CANVIAR IDIOMA (i18n) ---
Route::get('/locale/{locale}', function (string $locale) {
    $available = ['ca', 'es', 'en'];

    if (!in_array($locale, $available, true)) {
        $locale = config('app.fallback_locale', 'en');
    }

    Session::put('locale', $locale); // Guarda l'idioma a la sessió

    return redirect()->back();
})->name('setLocale');

// --- 🌍 RUTES PÚBLIQUES: INDEX ---
// Només permetem l'accés a la llista general sense estar loguejat
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);
Route::resource('jugadoras', JugadoraController::class)->only(['index']);
Route::resource('partits', PartitController::class)->only(['index']);

// --- 🔒 RUTES PROTEGIDES (AUTH) ---
Route::middleware('auth')->group(function () {
    // Perfil d'usuari (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestió: crear, guardar, editar, actualitzar i esborrar
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::resource('jugadoras', JugadoraController::class)->except(['index', 'show']);
    Route::resource('partits', PartitController::class)->except(['index', 'show']);
});

// --- 🌍 RUTES PÚBLIQUES: SHOW (AL FINAL) ---
// Es posen al final perquè el paràmetre {id} no confongui rutes com /create
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);
Route::resource('jugadoras', JugadoraController::class)->only(['show']);
Route::resource('partits', PartitController::class)->only(['show']);

require __DIR__ . '/auth.php';